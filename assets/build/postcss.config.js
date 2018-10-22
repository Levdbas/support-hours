const cssnanoConfig = {
  preset: ['default', {
    discardComments: { removeAll: true },
    reduceIdents: {
      exclude: true,
    },
    reduceTransforms: {
      exclude: true,
    },
  }]
};

module.exports = {
  plugins: {
    cssnano: process.env.NODE_ENV == 'production' ? cssnanoConfig : false,
    autoprefixer: true,
  },
};
