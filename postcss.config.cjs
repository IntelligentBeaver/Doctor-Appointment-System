const postcss = require('postcss');
const postcssPresetEnv = require('postcss-preset-env');
module.exports = {
    plugins: [
        require('cssnano')({
            preset: 'default',
        }),
        require('tailwindcss'),
        require('autoprefixer'),
        postcssPresetEnv({
            /* use stage 3 features + css nesting rules */
            stage: 1,
            features: {
                'nesting-rules': true
            }
        })
    ],
};