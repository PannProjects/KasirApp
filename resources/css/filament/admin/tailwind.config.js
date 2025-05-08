const preset = require("../../../../vendor/filament/filament/tailwind.config.preset");

module.exports = {
    presets: [preset],
    content: [
        "./app/Filament/**/*.php",
        "./resources/views/filament/**/*.blade.php",
        "./vendor/filament/**/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#f5f6f3",
                    100: "#ebede7",
                    200: "#d7dbcf",
                    300: "#c3c9b7",
                    400: "#afb79f",
                    500: "#9ba587",
                    600: "#636D4A", // Base color
                    700: "#4f563b",
                    800: "#3b402c",
                    900: "#272b1d",
                    950: "#13150e",
                },
                secondary: {
                    50: "#f5f5f2",
                    100: "#ebebe5",
                    200: "#d7d7cb",
                    300: "#c3c3b1",
                    400: "#afaf97",
                    500: "#A5AB85", // Base color
                    600: "#6e7259",
                    700: "#52563f",
                    800: "#373a25",
                    900: "#1b1d0b",
                    950: "#0e0f06",
                },
                accent: {
                    50: "#f5f2ef",
                    100: "#ebe5df",
                    200: "#d7cbbf",
                    300: "#c3b19f",
                    400: "#af977f",
                    500: "#A78963", // Base color
                    600: "#6e5a42",
                    700: "#524331",
                    800: "#372c20",
                    900: "#1b160f",
                    950: "#0e0b08",
                },
                brown: {
                    50: "#f5f0ed",
                    100: "#ebe1db",
                    200: "#d7c3b7",
                    300: "#c3a593",
                    400: "#af876f",
                    500: "#916639", // Base color
                    600: "#614226",
                    700: "#48311c",
                    800: "#302112",
                    900: "#181009",
                    950: "#0c0804",
                },
                dark: {
                    50: "#f5f2f0",
                    100: "#ebe5e1",
                    200: "#d7cbc3",
                    300: "#c3b1a5",
                    400: "#af9787",
                    500: "#5A2F0D", // Base color
                    600: "#3c1f09",
                    700: "#2d1706",
                    800: "#1e0f04",
                    900: "#0f0802",
                    950: "#080401",
                },
            },
        },
    },
};
