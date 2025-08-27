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
            backgroundImage: {
                "ghana-gradient":
                    "linear-gradient(90deg, #006b3f, #fcd116, #ce1126)",
            },
            textColor: {
                "ghana-gradient": "transparent", // fallback
            },
            backgroundClip: {
                text: "text",
            },
        },
    },
    plugins: [forms],
};
