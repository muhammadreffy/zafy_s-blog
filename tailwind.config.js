/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                manrope: ["Manrope", "ui-sans-serif", "system-ui"],
            },

            colors: {
                primary: "#087EA4",
                secondary: "#4b5563",
                tertiary: "#404756",
                quartenary: "#FFFFFF",
                color_hover: "#3998B6",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
