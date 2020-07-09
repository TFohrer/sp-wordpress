# X-Child theme for sp website

## Getting started

Copy child theme into default wordpress themes folder (`wp-content/themes`)

<br>

Install dependencies

```
  yarn install
```

<br>
Build

```
    yarn build
    # or
    yarn watch
```

<br>
Build for prod

```
    yarn dist
```

## How To

### Include images/icons in scss

Webpack is configured to automatically "build" any image that is imported in js or included in scss.
For example:

```
    background-image: url('../assets/images/svgs/arrow_right.svg');
```

Automatically copies the image to the build folder, so that it can be used.

## Features

- Babel transpiler
- PostCSS autoprefixer
- UglifyJS

## Possible improvements

- add HMR
- use `terser`
- add tests
