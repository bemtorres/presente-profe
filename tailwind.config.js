/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('flowbite/plugin')
  ],
  // daisyui: {
  //   themes: ["light", "cupcake"],
  // },
}



// /** @type {import('tailwindcss').Config} */
// export default {
//   content: [
//     "./resources/**/*.blade.php",
//     "./resources/**/*.js",
//     "./resources/**/*.vue",
//   ],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }
