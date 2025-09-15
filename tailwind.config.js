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
                ghBlack: "#000000",
                ghRed: "#EF3340",
                ghGold: "#FFD100",
                ghGreen: "#009739",
            },
            backgroundImage: {
                // Ghana flag gradient — use as: bg-ghana-gradient
                "ghana-gradient":
                    "linear-gradient(90deg, #006b3f, #fcd116, #ce1126)",
            },
        },
    },
    plugins: [forms],
};
