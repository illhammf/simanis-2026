/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");
const defaultTheme = require("tailwindcss/defaultTheme");
import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    content: [
        "./resources/**/*.blade.php",
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
        "./vendor/awcodes/overlook/resources/**/*.blade.php",
        "./vendor/diogogpinto/filament-auth-ui-enhancer/resources/**/*.blade.php",
    ],
    darkMode: "class",
    presets: [preset],
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
    ],
};