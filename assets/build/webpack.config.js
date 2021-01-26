process.noDeprecation = true;
const env = process.env.NODE_ENV;
const devMode = process.env.NODE_ENV !== 'production';
const path = require('path');
const webpack = require('webpack');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const ImageminPlugin = require('imagemin-webpack');
const imageminGifsicle = require('imagemin-gifsicle');
const imageminJpegtran = require('imagemin-jpegtran');
const imageminOptipng = require('imagemin-optipng');
const imageminSvgo = require('imagemin-svgo');
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
                            sourceMap: config.sourceMaps,
                        },
                    },
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: config.sourceMaps,
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: config.sourceMaps,
                            config: {
                                path: __dirname + '/postcss.config.js',
                            },
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: config.sourceMaps,
                        },
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
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        }),
    ],
    optimization: {
        minimizer: [
            new TerserPlugin({
                cache: true,
                parallel: true,
                sourceMap: config.sourceMaps,
            }),
            new ImageminPlugin({
                bail: false, // Ignore errors on corrupted images
                cache: true,
                name: '[path][name].[ext]',
                imageminOptions: {
                    // Lossless optimization with custom option
                    // Feel free to experement with options for better result for you
                    plugins: [
                        imageminGifsicle({
                            interlaced: true,
                        }),
                        imageminJpegtran({
                            progressive: true,
                        }),
                        imageminOptipng({
                            optimizationLevel: 1,
                        }),
                        imageminSvgo({
                            removeViewBox: false,
                        }),
                    ],
                },
            }),
        ],
    },
};
if (process.env.NODE_ENV === 'production') {
    webpackConfig.plugins.push(new CleanWebpackPlugin());
}
module.exports = webpackConfig;
