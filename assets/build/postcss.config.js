const cssnanoConfig = {
  preset: [
    "default",
    { discardComments: { removeAll: true }, reduceIdents: false }
  ]
};

module.exports = {
  plugins: {
    cssnano: false,
    autoprefixer: true
  }
};
