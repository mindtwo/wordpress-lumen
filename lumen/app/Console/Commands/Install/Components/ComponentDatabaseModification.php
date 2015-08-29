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

		$excecute_commands = [
			"cd {$this->home_dir} && php wp-cli.phar db reset --yes",
			"cd {$this->home_dir} && php wp-cli.phar core install --url=http://wordpress-lumen.dev/ --title=WordPress/Lumen --admin_user=admin --admin_password=166328 --admin_email=info@mindtwo.de",
			"cd {$this->home_dir} && php wp-cli.phar theme activate default",
			"cd {$this->home_dir} && php wp-cli.phar plugin install regenerate-thumbnails",
			"cd {$this->home_dir} && php wp-cli.phar plugin install wp-optimize",
			"cd {$this->home_dir} && php wp-cli.phar plugin install better-wp-security",
			"cd {$this->home_dir} && php wp-cli.phar plugin install w3-total-cache",
			"cd {$this->home_dir} && php wp-cli.phar plugin install timber-library",
			"cd {$this->home_dir} && php wp-cli.phar plugin activate --all",
			"cd {$this->home_dir} && php wp-cli.phar core update",
			"cd {$this->home_dir} && php wp-cli.phar core update-db",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update siteurl \"http://wordpress-lumen.dev\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update home \"http://wordpress-lumen.dev\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update blogdescription \"\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update page_on_front \"2\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update page_for_posts \"3\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update default_ping_status \"closed\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar option update permalink_structure \"/%postname%/\"",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post update 2 --post_name=\"home\" --post_title=\"Home\" --comment_status=closed --ping_status=closed",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post create --post_type=page --post_title=\"Blog\" --post_name=\"blog\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post create --post_type=page --post_title=\"Contact\" --post_name=\"contact\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post create --post_type=page --post_title=\"Landingpage\" --post_name=\"landingpage\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post create --post_type=page --post_title=\"Team\" --post_name=\"team\" --post_status=publish",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post meta set 4 _wp_page_template template-contact.php",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post meta set 5 _wp_page_template template-landingpage.php",
			"cd {$this->home_dir} && php wp-cli.phar php wp-cli.phar post meta set 6 _wp_page_template template-team.php",
		];

		foreach ( $excecute_commands as $command ) {
			echo shell_exec( $command );
		}
	}
}