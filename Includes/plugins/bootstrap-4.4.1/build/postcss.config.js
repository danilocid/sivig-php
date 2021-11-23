'use strict'

module.exports = (ctx) => ({
  map: ctx.file.dirname.Includes('examples') ? false : {
    inline: false,
    annotation: true,
    sourcesContent: true
  },
  plugins: {
    autoprefixer: {
      cascade: false
    }
  }
})
