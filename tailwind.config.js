import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "ghana-red": "#CE1126",
                "ghana-yellow": "#FCD116",
                "ghana-green": "#006B3F",
                "ghana-black": "#000000",
                "ghana-gold": "#FFD700",
            },
            backgroundImage: {
                "ghana-gradient":
                    "linear-gradient(90deg, #006b3f, #fcd116, #ce1126)",
            },
        },
    },
    plugins: [forms],
};
