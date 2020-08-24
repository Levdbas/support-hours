const cssnanoConfig = {
  reduceIdents: false,
  discardUnused: {
    keyframes: false
  },
  preset: ['default', {
    discardComments: { removeAll: true },
  }]
};

module.exports = {
  plugins: [
    require('autoprefixer'),
    require('cssnano')(cssnanoConfig),
  ]
}
