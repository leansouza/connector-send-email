'use strict';
const { VueLoaderPlugin } = require('vue-loader');
const webpack = require('webpack');
module.exports = {
  mode: 'development',
  target: 'node',
  entry: [
    './src/app.js'
  ],
  module: {
    rules: [
      {
        test: /\.vue$/,
        use: {
          loader: 'vue-loader',
          options: {
            optimizeSSR: false,
          },
        }
      },
      {
        test: /\.css$/,
        loaders: ['css-loader']
      },
      {
        test: /\.node$/,
        use: 'node-loader'
      }
    ]
  },
  resolve: {
    extensions: ['*', '.js', '.vue', '.json']
  },
  plugins: [
    new VueLoaderPlugin(),
  ],
}