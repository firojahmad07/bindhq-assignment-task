const path = require('path');
const { VueLoaderPlugin }  = require('vue-loader');
var webpack = require('webpack');
var basePath    = "./public/bundles/spygarmarketing";

const webpackConfig = {
    mode: 'development',
    entry: path.resolve(__dirname, basePath+"/js/index.js"),
    output:{
        path: path.resolve(__dirname, "./public/dist/"),
        filename: "bundle.min.js",
        publicPath: "./dist/",
        sourceMapFilename: "./public/dist/[name].js.map"
    },
    devtool: "source-map",
    module: {
        rules:[ { 
                test: /\.vue$/, 
                use: [ 'vue-loader' ],
            }, { 
                test: /\.(png|svg|jpg|jpeg|gif|woff|woff2|eot|ttf)$/i,
                use: ['file-loader']
            },  { test: /\.css$/, use: [ 'style-loader', 'css-loader' ]}       
        ]
    },
    plugins: [        
        new VueLoaderPlugin(),
        new webpack.ProvidePlugin({
            $: "jquery",
            jQuery: "jquery",
            jquery: "jquery"
        }),
    ],
    resolve: {
        extensions: ['.js', '.vue', '.json', '.css'],
        alias: {
            '@': path.resolve(basePath),
        }
    }
};

module.exports = webpackConfig;