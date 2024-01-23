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

        extend: {
            animation: {
                "fade-in": "fadeIn 800ms ease-out",
            },
            keyframes: {
                fadeIn: {
                    from: { opacity: "0" },
                    to: { opacity: "1" },
                },
            },
        },
    },




    
    daisyui: {
        // This is for theme when users enable the dark mode.
        darkTheme: "dark",
        themes: [
            {
                // The first theme will get applied as light mode.
                mytheme: {
                    primary: "#2e37ff",
                    secondary: "#009700",
                    accent: "#00e6d3",
                    neutral: "#100309",
                    "base-100": "#F9F7EE",
                    info: "#0090de",
                    success: "#00fdc8",
                    warning: "#ea5f00",
                    error: "#db0021",
                },
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
            "dark",
            "cupcake",
            "nord",
            "winter",
            "nord",
            "black",
        ],
    },
    plugins: [require("daisyui"), forms],
};
