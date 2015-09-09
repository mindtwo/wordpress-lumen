<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentDatabaseModification
 */
class ComponentDatabaseModification extends ComponentBase implements WpInstallComponentsInterface {

	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the component.
	 *
	 * @return mixed
	 */
	public function fire() {

		// Use WordPress cli manually!
		if ( $this->filesystem->exists( '/Applications/MAMP/Library/bin' ) ) {
			return true;
		}

		// Get translations
		$contact = app('translator')->get('install.wordpress-database.contact');
		$team = app('translator')->get('install.wordpress-database.team');
		$landingpage = app('translator')->get('install.wordpress-database.landingpage');
		$home = app('translator')->get('install.wordpress-database.home');
		$blog = app('translator')->get('install.wordpress-database.blog');

		$excecute_commands = [
			"cd {$this->home_dir} && php wp-cli.phar db reset --yes",
			"cd {$this->home_dir} && php wp-cli.phar core install --url={$this->config->wordpress_install->wordpress_primary_domain} --title={$this->config->wordpress_install->site_name} --admin_user={$this->config->wordpress_install->admin_username} --admin_password={$this->config->wordpress_install->admin_pass} --admin_email={$this->config->wordpress_install->admin_email}",
			"cd {$this->home_dir} && php wp-cli.phar theme activate default",
			"cd {$this->home_dir} && php wp-cli.phar plugin install regenerate-thumbnails",
			"cd {$this->home_dir} && php wp-cli.phar plugin install wp-optimize",
			"cd {$this->home_dir} && php wp-cli.phar plugin install better-wp-security",
			"cd {$this->home_dir} && php wp-cli.phar plugin install w3-total-cache",
			"cd {$this->home_dir} && php wp-cli.phar plugin install timber-library",
			"cd {$this->home_dir} && php wp-cli.phar plugin activate --all",
			"cd {$this->home_dir} && php wp-cli.phar core update",
			"cd {$this->home_dir} && php wp-cli.phar core update-db",
			"cd {$this->home_dir} && php wp-cli.phar option update siteurl \"{$this->config->wordpress_install->wordpress_primary_domain}\"",
			"cd {$this->home_dir} && php wp-cli.phar option update home \"{$this->config->wordpress_install->wordpress_primary_domain}\"",
			"cd {$this->home_dir} && php wp-cli.phar option update blogdescription \"\"",
			"cd {$this->home_dir} && php wp-cli.phar option update show_on_front \"page\"",
			"cd {$this->home_dir} && php wp-cli.phar option update page_on_front \"2\"",
			"cd {$this->home_dir} && php wp-cli.phar option update page_for_posts \"3\"",
			"cd {$this->home_dir} && php wp-cli.phar option update default_ping_status \"closed\"",
			"cd {$this->home_dir} && php wp-cli.phar option update permalink_structure \"/%postname%/\"",
			"cd {$this->home_dir} && php wp-cli.phar option add medium_crop \"1\"",
			"cd {$this->home_dir} && php wp-cli.phar option add medium_size_h \"300\"",
			"cd {$this->home_dir} && php wp-cli.phar option add medium_size_w \"300\"",
			"cd {$this->home_dir} && php wp-cli.phar post update 2 --post_name=\"$home\" --post_title=\"$home\" --comment_status=closed --ping_status=closed",
			"cd {$this->home_dir} && php wp-cli.phar post create --post_type=page --post_title=\"$blog\" --post_name=\"$blog\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar post create --post_type=page --post_title=\"$contact\" --post_name=\"$contact\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar post create --post_type=page --post_title=\"$landingpage\" --post_name=\"$landingpage\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar post create --post_type=page --post_title=\"$team\" --post_name=\"$team\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar post meta set 4 _wp_page_template template-contact.php",
			"cd {$this->home_dir} && php wp-cli.phar post meta set 5 _wp_page_template template-landingpage.php",
			"cd {$this->home_dir} && php wp-cli.phar post meta set 6 _wp_page_template template-team.php",
		];

		foreach ( $excecute_commands as $command ) {
			echo shell_exec( $command );
		}
	}
}