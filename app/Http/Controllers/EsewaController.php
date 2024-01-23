<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Cixware\Esewa\Client;
use Cixware\Esewa\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

require '../vendor/autoload.php';

class EsewaController extends Controller
{
    private function renderMessageView($msg, $desc, $type)
    {

        return view('payments.message', compact('msg', 'desc', 'type'));
    }

    public function create($appointmentID)
    {
        $appointment = Appointment::where('AppointmentID', $appointmentID)->first();

        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $address = Auth::user()->patient->Address;
        return view("payments.payments", compact("name", "email","address", "appointment"));
    }
    public function store(Request $request)
    {
        $pid = uniqid();
        // $amount = $request->amount;
        $amount = 500;

        $id = Auth::user()->id;
        $name = Auth::user()->name;
        $email = Auth::user()->email;

        Order::create([
            'user_id' => $id,
            'AppointmentID' => $request->appointment_id,
            'Name' => $name,
            'Email' => $email,
            'product_id' => $pid,
            'amount' => $request->amount,
            'esewa_status' => 'unverified',
            'created_at' => Carbon::now(),
        ]);

        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // Config for development.
        $config = new Config($successUrl, $failureUrl);

        // Config for production.
        // $config = new Config($successUrl, $failureUrl, 'b4e...e8c753...2c6e8b');

        // Initialize eSewa client.
        $esewa = new Client($config);
        $esewa->process($pid, $amount, 0, 0, 0);
    }

    public function paymentSuccess()
    {
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amt = $_GET['amt'];

        $order = Order::where('product_id', $pid)->first();
        if($order){
            $order->appointment->update([
            'Status' => 'Booked',
            ]);
            $update_status = Order::find($order->OrderID)->update([
                'esewa_status' => 'verified',
                'updated_at' => Carbon::now(),
            ]);
        }
        
        if ($update_status) {
            $type = 'success';
            $msg = 'Success!';
            $desc = 'Your Payment was Successfull';
            return $this->renderMessageView($msg, $desc, $type);
        }
    }
    public function paymentFailure()
    {
        $pid = $_GET['pid'];

        $order = Order::where('product_id', $pid)->first();
        // dd($order);
        $update_status = Order::find($order->OrderID)->update([
            'esewa_status' => 'failed',
            'updated_at' => Carbon::now(),
        ]);
        if ($update_status) {
            $type = 'error';
            $msg = 'Failure!';
            $desc = 'Your Payment was Unsuccessfull';
            return $this->renderMessageView($msg, $desc, $type);
        }
    }
}