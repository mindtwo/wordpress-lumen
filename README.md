# WordPress Lumen Starter-Package

## Status
Package is currently in development.

Finished:
- Install routine
- Lumen WordPress connection

ToDos:
- Optimize theme
- Use twig templating in theme

## Server Requirements
- PHP Version > 5.5
- composer
- tar
- unzip

## Option Server Requirements
- Node
- NPM global Gulp
- NPM global Bower

## WordPress Commercial Plugin Requirements
- ACF Pro (http://www.advancedcustomfields.com/pro/)

## Installer
- Edit "/install/config/install-config-sample.json" with project settings and save as "/install/config/install-config.json"
- Replace "ACF_LICENCE_KEY" with your ACF license key
- Run 'composer install'
- If using gulp?
    - Run "npm install"
    - Run "bower install -y"
- Run "php artisan wp-lumen:refresh-dotenv-file"
- Run "php artisan wp-lumen:install"
- Set document root to "/public"
- Restart apache or nginx
- Fill ACF Pro option page
- Setup backup script in crontab "* * * * * php artisan schedule:run >> /dev/null 2>&1"

## Setting up Total Cache Plugin
```bash
chmod 777 /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/cache
chmod 777 /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/w3tc-config
rm -rf /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/cache/config
rm -rf /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/cache/tmp
```

## Working with wp-cli.phar
```bash
cd /project-folder
php wp-cli.phar post update 2 --post_name="home" --post_title="Home" --comment_status=closed --ping_status=closed
php wp-cli.phar post create --post_type=page --post_title="Contact" --post_name="contact" --post_status=publish
php wp-cli.phar post create --post_type=page --post_title="Landingpage" --post_name="landingpage" --post_status=publish
```

## Documentation
Theme function description is coming soon...

## Demosite
**Link:** http://wordpress-lumen.mindtwo.de/