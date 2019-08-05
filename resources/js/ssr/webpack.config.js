'use strict'
const { VueLoaderPlugin } = require('vue-loader')
const webpack = require('webpack')
const path = require('path')

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
        use: 'vue-loader'
      },
      {
        test: /\.css$/,
        loaders: ['css-loader']
      },
    ]
  },
  resolve: {
    extensions: ['*', '.js', '.vue', '.json']
  },
  plugins: [
    new VueLoaderPlugin(),
  ],
  resolve: {
    alias: {
      'tinymce': path.resolve(__dirname, 'src/dummies'),
      '@tinymce/tinymce-vue$': path.resolve(__dirname, 'src/rich-text-component.js')
    }
  }
}