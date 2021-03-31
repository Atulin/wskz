# WSKZ

## Getting Started

1. Create database using the `/sql/dbup.sql` dump
2. Create a `.env` file based on the structure of `.env.template`
   1. `ENV` set to `DEV` will show all errors, set to anything else will hide them
   2. The rest is for database connection configuration
3. Best run via Apache

## Building

This code contains generated autoloader and built static assets. However, a need might arise to re-build them.

### Static assets

`gulp build` to build them all, `gulp dev` to watch for changes

### Autoloader

`composer dump-autoload` to regenerate the PSR-4 autoloader
