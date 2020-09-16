
# Kings2021 Theme

The Wordpress theme for the Kings Creatives website (2020/2021), based on the Timber Starter theme (a Twig-based theme based on the "\_s" theme).

## Installation [installation]

### Install these required plugins [install-plugins]

- _Timber_: The WordPress Timber Library allowing you to develop templates using [Twig](https://twig.symfony.com).
    - [Website](http://upstatement.com/timber)
    - [Documentation](https://github.com/jarednova/timber/wiki)
- _Advanced Custom Fields_: Configure custom field groups
    - [Website](https://www.advancedcustomfields.com/)
- _The Post Grid_: Layout grid for posts using the [Isotope](https://isotope.metafizzy.co) layout engine.
    - [Documentation](https://www.radiustheme.com/how-to-setup-configure-the-post-grid-free-version-for-wordpress/)
- _Contact Form 7_: Form builder.
    - [Website](https://contactform7.com/)

### Install the theme [install-theme]

Install the theme by copying the Kings2020 theme folder into wp-content/themes/ folder of your Wordpress installation. The repository for the theme can be found at [https://github.com/chrisplatts01/kings2020](https://github.com/chrisplatts01/kings2020)

## Building the theme [build]

Install [NodeJS](https://nodejs.org/en/) and [Yarn](https://yarnpkg.com).

Run `yarn install` to download the required node packages

Run `yarn build` to clean, bundle, compile and copy all assets

See [below for more commands](#commands).

## Folders [folders]

- `./assets/` -- Destination for generated CSS stylesheets and JS scripts, amd copied static assets (images, fonts, etc).
- `./src/` -- Source files for SCSS stylesheet files, JS scripts, images and fonts.
- `./templates/` -- Twig templates.
- `node_packages` -- NodeJS packages required to build and run the theme.
- `.git` -- Files for managing the Git repository.

## Files [files]

- `style.css` -- Definition file for the theme.
- `*.php` -- PHP view files - generally with a 1 to 1 relationship with the Twig files in `./templates/`.
- `package.json` -- Configuration for the node build system, including required node packages, CLI scripts for building the stylesheet and JS assets, etc.
- `webpack.config.js` -- Configuration file for the Webpack javascript bundler.

## Commands [commands]

- `yarn install` -- Install required node packages
- `yarn clean` -- Delete script and stylesheet assets
- `yarn clean:all` -- Delete all assets
- `yarn scripts` -- Bundle script assets
- `yarn styles` -- Compile stylesheet assets
- `yarn scripts:watch` -- Bundle script assets and watch for further changes to JS source files
- `yarn styles:watch` -- Compile stylesheets assets and watch for further changes to SCSS source files
- `yarn styles:prod` -- Compile and minify stylesheet assets
- `yarn scripts:prod` --  Bundle and minify script assets
- `yarn images` -- Copy image assets
- `yarn fonts` -- Copy font assets
- `yarn build` -- Delete and build script and stylesheet assets
- `yarn build:all` -- Delete and build/copy all assets
- `yarn build:prod` -- Delate, build/copy and minimise all assets
- `yarn watch` -- Bundle scripts, compile stylesheet assets and minify


## Other Resources [other-resources]

Check out these articles and projects for more info:

- [This branch](https://github.com/laras126/timber-starter-theme/tree/tackle-box) of the starter theme has some more example code with ACF and a slightly different set up.
- [Twig for Timber Cheatsheet](http://notlaura.com/the-twig-for-timber-cheatsheet/)
- [Timber and Twig Reignited My Love for WordPress](https://css-tricks.com/timber-and-twig-reignited-my-love-for-wordpress/) on CSS-Tricks
- [A real live Timber theme](https://github.com/laras126/yuling-theme).
- [Timber Video Tutorials](http://timber.github.io/timber/#video-tutorials) and [an incomplete set of screencasts](https://www.youtube.com/playlist?list=PLuIlodXmVQ6pkqWyR6mtQ5gQZ6BrnuFx-) for building a Timber theme from scratch.

