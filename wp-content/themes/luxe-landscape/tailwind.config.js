/** @type {import('tailwindcss').Config} */
module.exports = {
	// Enable class-based dark mode
	darkMode: "class",

	// Bento category grid: placement classes come from PHP; safelist so JIT never drops them.
	safelist: [
		"md:col-span-1",
		"md:col-span-2",
		"md:col-span-3",
		"md:col-span-4",
		"md:row-span-1",
		"md:row-span-2",
		"md:col-start-1",
		"md:col-start-2",
		"md:col-start-3",
		"md:col-end-2",
		"md:col-end-3",
		"md:col-end-5",
		"md:row-start-1",
		"md:row-start-2",
		"md:row-end-2",
		"md:row-end-3",
	],

	// Specify the paths to all of the template files in your project
	content: [
		"./*.php",
		"./**/*.php",
		"./assets/js/**/*.js",
		"./layout/**/*.php",
		"./pages/**/*.php",
	],

	theme: {
		extend: {
			// Custom Colors extracted from Luxe Landscape theme
			colors: {
				primary: "#11d462",
				"background-light": "#f6f8f7",
				"background-dark": "#0d47a1",
				"neutral-charcoal": "#1a1c1b",
				alabaster: "#f2f2f2",
			},
			// Custom Fonts
			fontFamily: {
				display: ['"Space Grotesk"', '"Cairo"', "sans-serif"],
			},
			// Custom Border Radii
			borderRadius: {
				DEFAULT: "0.5rem",
				lg: "1rem",
				xl: "1.5rem",
				full: "9999px",
			},
		},
	},

	// Include popular plugins used in the theme
	plugins: [require("@tailwindcss/forms"), require("@tailwindcss/container-queries")],
};
