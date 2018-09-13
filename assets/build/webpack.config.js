/**
* Assets Config file
*/
process.noDeprecation = true;
const env = process.env.NODE_ENV;
const path = require('path');
const webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack-plugin').default
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const rootPath = process.cwd();
var configFile = require(path.resolve(__dirname,rootPath)+'/assets/config.json');

const variables = {
  browserSyncURL: configFile['browserSyncURL'],
  browserSyncPort: configFile['browserSyncPort'],
  themePath: path.join(rootPath, configFile['themePath']), // from root folder path/to/theme
  distPath:   path.join(rootPath, configFile['themePath'], 'dist'), // from root folder path/to/theme
  assetsPath: path.join(rootPath, configFile['assetsPath']), // from root folder path/to/assets
};

const ExtractNormalCSS  = new ExtractTextPlugin(process.env.NODE_ENV === 'production' ? 'styles/[name].[chunkhash].css' : 'styles/[name].css');
const ExtractCriticalCSS  = new ExtractTextPlugin('styles/critical.php');

if (process.env.NODE_ENV === undefined) {
  process.env.NODE_ENV = isProduction ? 'production' : 'development';
}

const config = {
  context: variables.assetsPath,
  entry: {
    'support-hours-admin': ['./scripts/support-hours-admin.js', './styles/support-hours-admin.scss']
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'buble-loader', options: { objectAssign: 'Object.assign' }
        }
      },
      {
        test: /\.(css|scss|sass)$/,
        include: variables.assetsPath,
        exclude: /critical.scss$/,
        use: ExtractNormalCSS.extract({
          fallback: 'style-loader',
          use: [
            {loader: 'css-loader'},
            {
              loader: 'postcss-loader', options: {
                config:{
                  path: __dirname,
                },
              },
            },
            {loader: 'sass-loader'}
          ],
          publicPath: '../',
        }),
      },
      {
        test: /\.(ttf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
        include: variables.assetsPath,
        loader: 'url-loader',
        options: {
          limit: 4096,
          name: '[path][name].[ext]',
        },
      },
    ]
  },
  output: {
    filename: 'scripts/[name].js',
    path: path.resolve(__dirname, variables.distPath)
  },
  externals: {
    jquery: 'jQuery'
  },
  plugins: [
    new webpack.ProvidePlugin({
      Component: 'materialize-css/js/component.js',
      Modal: 'materialize-css/js/modal.js',
      $: 'jquery',
      jQuery: 'jquery'
    }),
    ExtractNormalCSS,
    new BrowserSyncPlugin({
      host: 'localhost',
      proxy: variables.browserSyncURL,
      delay: 500,
      watch: true,
      watchOptions: {
        aggregateTimeout: 300,
        poll: 1000,
        ignored: /node_modules/,
      },
      files: [
        variables.themePath+'/**/*.php'
      ],
    }),
    new CopyWebpackPlugin([
      {
        context: variables.assetsPath+'/images',
        from: '**/*',
        to: process.env.NODE_ENV === 'production' ? 'images/[name].[hash].[ext]' : 'images/[name].[ext]',
      }
    ],{
      ignore: [
        '.gitkeep'
      ],
      copyUnmodified: true,
    }
  ),
]
};

if (process.env.NODE_ENV === 'production') {
  config.plugins.push(
    new UglifyJsPlugin({
    }),
    new OptimizeCssAssetsPlugin({
      assetNameRegExp: /(critical.php|\.css)$/i,
    }),
    new ImageminPlugin({
      disable: process.env.NODE_ENV !== 'production',
      test: /\.(jpe?g|png|gif|svg)$/i
    })
  );
}
module.exports = config
