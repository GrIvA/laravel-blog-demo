#/usr/bin/bash

cd /home/webdev10/www/mono/sass
sass -s compressed --no-source-map main.scss main.css
mv main.css ../public/css/main.css
