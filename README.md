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
- Ruby, Node, NPM global Gulp (optional), NPM global Bower (optional)

## WordPress Commercial Plugin Requirements
- ACF Pro (http://www.advancedcustomfields.com/pro/)
- wpSEO (https://wpseo.de/)

## Installer
- Edit "/install/config/installer-config-sample.json" with project settings and save as "/install/config/installer-config.json"
- Run 'composer install --working-dir="./lumen"'
- If using gulp?
    - Run "/resources/assets/npm update"
    - Run "bower install -y --config.cwd="./resources/assets""
- Run "php /lumen/artisan wp-lumen:refresh-dotenv-file"
- Run "php /lumen/artisan wp-lumen:install"
- Set document root to "/public"
- Restart apache or nginx
- Import ACF .json files from "public/wp-content/themes/default/acf-json"
- Fill ACF Pro option page
- Setup backup script in crontab "bash backup/backup.sh"
- Setup correct file and folder access rights:
```bash
find /public/ -type d -exec chmod 755 {} \;
find /public/ -type f -exec chmod 644 {} \;
```

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