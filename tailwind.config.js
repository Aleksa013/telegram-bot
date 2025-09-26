const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Josefin Sans", ...defaultTheme.fontFamily.sans],
                serif: ["Cormorant Infant", ...defaultTheme.fontFamily.serif],
            },
            colors: {
                dark_bg: "#292E36",
                light_bg: "#FFF8F5",
                white_bg: "#FFF",
                primary_gray: "#5C6168",
                primary_orange: "#E1B168",
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
