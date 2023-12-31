const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
module.exports = {
  mode: 'development',
  watch: true,
  entry: {
    'js/app' : './src/js/app.js',
    'js/inicio' : './src/js/inicio.js',
    'js/habitacionesadmin/index' : './src/js/habitacionesadmin/index.js',
    'js/habitacionesclientes/index' : './src/js/habitacionesclientes/index.js',
    'js/habitacionesempleados/index' : './src/js/habitacionesempleados/index.js',
    'js/activacion/index' : './src/js/activacion/index.js',
    'js/lista/index' : './src/js/lista/index.js',
    'js/login/index' : './src/js/login/index.js',
    'js/registro/index' : './src/js/registro/index.js',
    'js/reservaciones/index' : './src/js/reservaciones/index.js',
    'js/reservacionescliente/index' : './src/js/reservacionescliente/index.js',
    'js/disponibilidad/estadistica' : './src/js/disponibilidad/estadistica.js',
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'public/build')
  },
  plugins: [
    new MiniCssExtractPlugin({
        filename: 'styles.css'
    })
  ],
  module: {
    rules: [
      {
        test: /\.(c|sc|sa)ss$/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader
            },
            'css-loader',
            'sass-loader'
        ]
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        loader: 'file-loader',
        options: {
           name: 'img/[name].[hash:7].[ext]'
        }
      },
    ]
  }
};