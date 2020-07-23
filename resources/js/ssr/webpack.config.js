'use strict';
const { VueLoaderPlugin } = require('vue-loader');
const webpack = require('webpack');
const path = require('path');
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
    extensions: ['*', '.js', '.vue', '.json'],
    alias: {
      vue: path.resolve(__dirname, 'node_modules/vue/dist/vue.js'),
    },
  },
  plugins: [
    new VueLoaderPlugin(),
  ],
  externals: [
    'monaco-editor'
  ]
}