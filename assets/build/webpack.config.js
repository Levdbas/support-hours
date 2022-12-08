process.noDeprecation = true;
const env = process.env.NODE_ENV;
const devMode = process.env.NODE_ENV !== 'production';
const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const { merge } = require('webpack-merge');
const rootPath = process.cwd();

var userConfig = require(path.resolve(__dirname, rootPath) + '/assets/config.json');

const config = merge(
    {
        path: {
            theme: path.join(rootPath, userConfig['themePath']), // from root folder path/to/theme
            dist: path.join(rootPath, userConfig['themePath'], 'dist'), // from root folder path/to/theme
            assets: path.join(rootPath, userConfig['assetsPath']), // from root folder path/to/assets
        },
    },
    userConfig,
);

const webpackConfig = {
    context: config.path.assets,
    entry: config.entry,
    devtool: config.sourceMaps ? 'source-map' : false,
    mode: env,
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        babelrc: false,
                        cacheDirectory: true,
                    },
                },
            },
            {
                test: /\.scss$/,
                exclude: /node_modules/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            publicPath: '../',
                        },
                    },
                    {
                        loader: 'css-loader',
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                config: __dirname + '/postcss.config.js',
                            },
                        },
                    },
                    {
                        loader: 'sass-loader',
                    },
                ],
            },
            {
                test: /\.(ttf|eot|woff2?|png|jpe?g|gif|svg|ico)$/,
                include: config.path.assets,
                loader: 'url-loader',
                options: {
                    limit: 4096,
                    name: '[path][name].[ext]',
                },
            },
        ],
    },
    output: {
        filename: 'scripts/[name].js',
        path: path.resolve(__dirname, config.path.dist),
        pathinfo: false,
    },
    externals: {
        jquery: 'jQuery',
    },
    performance: { hints: false },
    plugins: [
        new BrowserSyncPlugin({
            host: 'localhost',
            proxy: config.browserSyncURL,
            files: [config.path.theme + '/**/*.php', config.path.theme + '/**/*.twig'],
        }),
        new MiniCssExtractPlugin({
            filename: 'styles/[name].css',
        }),
    ],
    externals: {
        jquery: 'jQuery',
    },
    optimization: {
        minimizer: [
            new TerserPlugin({
                parallel: true,
            }),
        ],
    },
};
if (process.env.NODE_ENV === 'production') {
    webpackConfig.plugins.push(new CleanWebpackPlugin());
}
module.exports = webpackConfig;
