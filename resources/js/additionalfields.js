document.getElementById("role").addEventListener("change", function () {
    var role = this.value;

    // Reset fields
    document.getElementById("patientField1").style.display = "none";
    document.getElementById("patientField2").style.display = "none";
    document.getElementById("doctorFields").style.display = "none";
    document.getElementById("specializationFields").style.display = "none";

    // Show fields based on role
    if (role === "doctor") {
        document.getElementById("doctorFields").style.display = "block";
        document.getElementById("specializationFields").style.display = "block";
    } else if (role === "patient") {
        document.getElementById("patientField1").style.display = "block";
        document.getElementById("patientField2").style.display = "block";
    }
});
