const GoogleFontsPlugin = require("google-fonts-webpack-plugin")

module.exports = {
  runtimeCompiler: true,

  plugins: [
    new GoogleFontsPlugin({
        fonts: [
            { family: "Source Sans Pro" },
            { family: "Roboto", variants: [ "400", "700italic" ] },
            { family: "Montserrat+Alternates"},
            { family: "Montserrat"}
        ]
    })
]
};
