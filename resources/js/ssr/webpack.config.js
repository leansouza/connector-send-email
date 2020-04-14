'use strict';
const { VueLoaderPlugin } = require('vue-loader');
const webpack = require('webpack');

var config = {
  mode: 'development',
  target: 'node',
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

var entryConfig = Object.assign({}, config, {
  name: 'entry',
  entry: './entry.js',
  externals: {
    canvas: "commonjs canvas"
  },
  output: {
    path: __dirname + '/dist',
    filename: 'entry.js'
  }
});

var mainConfig = Object.assign({}, config, {
  name: 'main',
  entry: './src/app.js',
  output: {
    path: __dirname + '/dist',
    filename: 'main.js'
  }
});

module.exports = [ entryConfig, mainConfig];

// module.exports = {
//   mode: 'development',
//   target: 'node',
//   entry: [
//     './entry.js',
//     './src/app.js'
//   ],
//   module: {
   
//   },
//   resolve: {
//     extensions: ['*', '.js', '.vue', '.json']
//   },
//   plugins: [
//     new VueLoaderPlugin(),
//   ],
// }
