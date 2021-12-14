const path = require('path')

/**
 * A helper function to create Vue CLI page entries
 * @param {string} name The name of the the JavaScript entry point for the page
 * @param {string} outputPath The path to the resulting HTML Blade file without the extension
 * @param {string} template An optional template file to be used as the base of the HTML file
 * @returns
 */
const page = (name, outputPath, template) => {
  return {
    [name]: {
      entry: `src/${name}.js`,
      filename: path.resolve(__dirname, `views/${process.env.VUE_APP_ENV_VIEWS_DIR}${outputPath}.blade.php`),
      template: template || 'src/templates/app.blade.php'
    }
  }
}

module.exports = {
  /**
   * If you're not aiming for a SPA
   * You can add as many pages here as you want
   */
  pages: {
    ...page('main', 'app')
  },

  // Where to dump resulting files
  outputDir: process.env.VUE_APP_OUTPUT_DIR,
  
  // The URL from which assets will be served
  // AND WHICH will be used for injected assets into our HTML
  publicPath: process.env.VUE_APP_ASSET_URL,
  
  css: {
    extract: true
  },
  
  devServer: {
    // Public needs to be explicitly set, since we're not using the defaults
    public: process.env.VUE_APP_ASSET_URL,
    
    // During development, we want to write ONLY the HTML files to the disk.
    // This is needed because Laravel won't be able to read the view directly from memory,
    // but, our assets will still be served directly from memory.
    // So, we're writing to disk ONLY if the output file path ends with .blade.php
    writeToDisk: (filePath) => {
      return /\.blade\.php$/.test(filePath)
    },
    
    // Allows you to point any host to the devserver port.
    // Eg.: http://assets.localhost:8080 will also work
    // Alternatively you could use the "allowedHosts" option
    disableHostCheck: true,
    
    // Avoid CORS problems
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, PATCH, OPTIONS',
      'Access-Control-Allow-Headers': 'X-Requested-With, content-type, Authorization'
    }
  },
  
  // Ensure that Vuetify files are transpiled by Babel.
  transpileDependencies: [
    'vuetify'
  ],

  // Disable prefetch links
  chainWebpack: config => {
    config.plugins.delete('prefetch-main')
  }  
}
