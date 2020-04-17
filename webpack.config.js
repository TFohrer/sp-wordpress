const path = require('path');

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const WebpackAssetsManifest = require('webpack-assets-manifest');

module.exports = {
    entry: ['./js/main.js', './sass/main.scss'],
    output: {
        filename: './main.min.[hash].js',
        path: path.resolve(__dirname) + '/build'
    },
    module: {
        rules: [
            // perform js babelization on all .js files
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            // compile all .scss files to plain old css
            {
                test: /\.(sass|scss)$/,
                use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader']
            }
        ]
    },
    plugins: [
        // extract css into dedicated file
        new MiniCssExtractPlugin({
            filename: './main.min.[hash].css'
        }),
        new WebpackAssetsManifest(),
        new CleanWebpackPlugin({
            cleanOnceBeforeBuildPatterns: ['./build/*']
        })
    ],
    optimization: {
        minimizer: [
            // enable the js minification plugin
            new UglifyJSPlugin({
                cache: true,
                parallel: true
            }),
            // enable the css minification plugin
            new OptimizeCSSAssetsPlugin({

            })
        ]
    }
};
