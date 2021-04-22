module.exports = {
    purge: [
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.vue",
        "./resources/**/*.js"
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
            colors: {
                black_cus: {
                    light: "#393F56",
                    default: "#1E212D",
                    dark: "#101218"
                },
                peach_cus: {
                    light: "#F8E9DE",
                    default: "#EABF9F",
                    dark: "#E2A679"
                },
                brown_cus: {
                    light: "#CEB0A1",
                    default: "#B68973",
                    dark: "#A06E54"
                },
                milk_cus: {
                    light: "#FFFFFF",
                    default: "#FAF3E0",
                    dark: "#F4E4B9"
                },
                pink_cus: {
                    light: "#EFA9B1",
                    default: "#E5707E",
                    dark: "#DC4153"
                },
                green_cus: {
                    light: "#D2EEE6",
                    default: "#A3DDCB",
                    dark: "#79CDB3"
                },
                yellow_cus: {
                    light: "#F7F7DE",
                    default: "#E8E9A1",
                    dark: "#DEE07B"
                },
                orange_cus: {
                    light: "#F1D5A7",
                    default: "#E6B566",
                    dark: "#E0A23E"
                }
            }
        }
    },
    variants: {
        extend: {}
    },
    plugins: []
};
