# WordPress Lumen Starter-Package

## Server Requirements
- PHP Version > 5.5
- tar
- unzip
- Ruby, Node, NPM Gulp (optional)

## WordPress Commercial Plugin Requirements
- ACF Pro (http://www.advancedcustomfields.com/pro/)
- wpSEO (https://wpseo.de/)

## Installer
- Edit "/install/config/installer-config-sample.json" with project settings and save as "/install/config/installer-config.json"
- Run "php /lumen/composer install"
- If using gulp?
    - Run "/resources/assets/npm update"
    - Run "/resources/assets/bower update"
- Run "php /lumen/artisan wp-lumen:install"
- Set document root to "/public"
- Restart apache or nginx
- Run WordPress installer "http://www.domain.com/"
- Import ACF .json files from "public/wp-content/themes/default/acf-json"
- Fill ACF Pro option page
- Setup backup script in crontab "bash bash/backup/backup.sh"
- Activate plugins
- Execute:
```bash
find /public/ -type d -exec chmod 755 {} \;
find /public/ -type f -exec chmod 644 {} \;
```

## Working with wp-cli.phar
```bash
cd /project-folder
php wp-cli.phar post update 2 --post_name="home" --post_title="Home" --comment_status=closed --ping_status=closed
php wp-cli.phar post create --post_type=page --post_title="Contact" --post_name="contact" --post_status=publish
php wp-cli.phar post create --post_type=page --post_title="Landingpage" --post_name="landingpage" --post_status=publish
```

## Setting up Total Cache Plugin
```bash
chmod 777 /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/cache
chmod 777 /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/w3tc-config
rm -rf /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/cache/config
rm -rf /var/www/wordpress-lumen.mindtwo.de/system/public/wp-content/cache/tmp
```

## Documentation
Theme function description is coming soon...

## Demosite
**Link:** http://wordpress-lumen.mindtwo.de/