# Wordpress Theme – The_Wordpress_Theme_Boilerplate Theme Setup
## 1. Fork the repository

## 2. Find and Replace the following:
Hasel            -> PHP Theme Namespace (e.g. ABCTheme)
HASEL         -> Global Variable Prefix (e.g. ABC_)
hasel         -> Function & CSS Class Prefix (e.g. abc_)
Hasel         -> Package Name (e.g. ABC Theme)

## 3. Rename the theme folder

## 4. Run from the php composer
````
    $ composer update && composer install && composer dump-autoload -o
````

## 5. get the Salemoche-Essentials Plugin and install the packages (unless already installed)
````
    $ cd ../../plugins && git clone git@github.com:Salemoche/salemoche-wordpress-essentials.git && cd salemoche-wordpress-essentials/assets && npm install && cd ../../../themes/{ your theme folder }
````

## 6. cd into assets
````
    $ cd assets
````

## 7. Install Packages
````
    $ npm install
````

## 8. Run the Webpack dev server for development
````
    $ npm run dev
````

## 9. All in one command
````
    $ 
````

# Todo:

    - # Hasel
# uzhsl
