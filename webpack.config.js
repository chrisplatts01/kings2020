const path = require('path');

module.exports = {
  devtool: 'source-map',
  entry: './src/scripts/main.js',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'assets/scripts'),
  },
};
