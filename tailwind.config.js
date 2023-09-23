/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'pink': '#F78CA2',
                'pink-hover': '#FFD1DA',
                'pink-active': '#FBA1B7',
            },
            fontFamily: {
                'la-doulasie': ['"Monsieur La Doulaise"', 'cursive'],
                'varela': ['"Varela Round"', 'cursive'],
                'great-vibes': ['"Great Vibes"', 'cursive'],
                'sacramento': ['"Sacramento"', 'cursive'],
            },
        },
    },
    plugins: [],
    darkMode: 'class',
}

