import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            xs: "475px",
            ...defaultTheme.screens,
        },

        extend: {},
    },
    daisyui: {
        darkTheme: "dark",
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["light"],
                    primary: "#007eff",
                    secondary: "#008200",
                    accent: "#00c3b8",
                    neutral: "#0a1503",
                    "base-100": "#fefff9",
                    info: "#00a9ff",
                    success: "#009e46",
                    warning: "#edb000",
                    error: "#dd1b53",
                },
            },
            "cupcake",
            "winter",
            "nord",
            "black"
        ],
    },
    plugins: [require("daisyui"), forms],
};
