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
                'quicksand': ['"Quicksand"', 'cursive'],
            },
            dropShadow: {
                'cust': [
                    '2px 2px 2px rgba(255, 255, 255, 1)',
                    '4px 4px 2px rgba(0, 0, 0, .25)',
                ]
            }
        },
    },
    plugins: [],
    darkMode: 'class',
}

