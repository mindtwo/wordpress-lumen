<?php

namespace App\Console\Commands\Install\Components;


use Faker\Factory as Faker;


/**
 * Class ComponentWpCli
 */
class ComponentWpCli extends ComponentBase implements WpInstallComponentsInterface {

	protected $faker;
	protected $wp_cli;
	protected $php_version;

	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct();

		$this->faker = Faker::create();
	}

	/**
	 * Execute the component.
	 *
	 * @return mixed
	 */
	public function fire() {
		$this->php_version = isset($this->config->php) ? $this->config->php : 'php -d allow_url_fopen=On';
		$this->wp_cli = "cd {$this->home_dir} && {$this->php_version} wp-cli.phar ";
		$wp_cli = $this->wp_cli;

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
		$imprint = app('translator')->get('install.wordpress-database.imprint');
		$privacy = app('translator')->get('install.wordpress-database.privacy');

		$exec = [
			$wp_cli . "db reset --yes",
			$wp_cli . "core install --url={$this->config->wordpress_install->wordpress_primary_domain} --title={$this->config->wordpress_install->site_name} --admin_user={$this->config->wordpress_install->admin_username} --admin_password={$this->config->wordpress_install->admin_pass} --admin_email={$this->config->wordpress_install->admin_email}",
			$wp_cli . "theme activate default",
			$wp_cli . "core update",
			$wp_cli . "core update-db",
			$wp_cli . "option update siteurl \"{$this->config->wordpress_install->wordpress_primary_domain}\"",
			$wp_cli . "option update home \"{$this->config->wordpress_install->wordpress_primary_domain}\"",
			$wp_cli . "option update blogdescription \"\"",
			$wp_cli . "option update show_on_front \"page\"",
			$wp_cli . "option update page_on_front \"2\"",
			$wp_cli . "option update page_for_posts \"3\"",
			$wp_cli . "option update default_ping_status \"closed\"",
			$wp_cli . "option update permalink_structure \"/%postname%/\"",
			$wp_cli . "option add medium_crop \"1\"",
			$wp_cli . "option update medium_size_h \"600\"",
			$wp_cli . "option update medium_size_w \"600\"",
			$wp_cli . "option update thumbnail_size_h \"300\"",
			$wp_cli . "option update thumbnail_size_w \"300\"",
			$wp_cli . "option update large_size_h \"1000\"",
			$wp_cli . "option update large_size_w \"1000\"",
			$wp_cli . "post update 2 --post_name=\"$home\" --post_title=\"$home\" --post_content='" . $this->faker->paragraph(5) . "' --comment_status=closed --ping_status=closed",
			$wp_cli . "post create --user=1 --post_type=page --post_title=\"$blog\" --post_name=\"$blog\" --post_status=publish",
			$wp_cli . "post create --user=1 --post_type=page --post_title=\"$contact\" --post_name=\"$contact\" --post_content='" . $this->get_text(1) . " [form]'  --post_status=publish",
			$wp_cli . "post create --user=1 --post_type=page --post_title=\"$landingpage\" --post_name=\"$landingpage\" --post_content='" . $this->get_text() . "'  --post_status=publish",
			$wp_cli . "post create --user=1 --post_type=page --post_title=\"$team\" --post_name=\"$team\" --post_content='" . $this->get_text(2) . "' --post_status=publish",
			$wp_cli . "post create --user=1 --post_type=page --post_title=\"$imprint\" --post_name=\"$imprint\" --post_content='" . $this->get_text(20) . "'  --post_status=publish",
			$wp_cli . "post create --user=1 --post_type=page --post_title=\"$privacy\" --post_name=\"$privacy\" --post_content='" . $this->get_text(20) . "'  --post_status=publish",
			$wp_cli . "post meta set 4 _wp_page_template template-contact.php",
			$wp_cli . "post meta set 5 _wp_page_template template-landingpage.php",
			$wp_cli . "post meta set 6 _wp_page_template template-team.php",

			// Set ACF options
			$wp_cli . "option add options_logo_alt \"{$this->config->wordpress_install->site_name}\"" ,
			$wp_cli . "option add _options_logo_alt \"field_54abbd55864e1\"" ,
			$wp_cli . "option add options_logo_image_filename \"logo.png\"" ,
			$wp_cli . "option add _options_logo_image_filename \"field_54abbd80864e2\"" ,

			// Add menus
			$wp_cli . "menu create \"Main\"",
			$wp_cli . "menu create \"Footer\"" ,
			$wp_cli . "menu location assign main menu-main",
			$wp_cli . "menu location assign footer menu-footer",

			// Add default conversion terms
			$wp_cli . "term create conversion-source \"Form Contact\" --slug=\"form_contact\"",
			$wp_cli . "term create conversion-source \"Form Callback\" --slug=\"form_callback\"",
			$wp_cli . "term create conversion-source \"Form Application\" --slug=\"form_application\"",

			// Add menu items
			$wp_cli . "menu item add-post main 2 --title=\"$home\"",
			$wp_cli . "menu item add-post main 6 --title=\"$team\"",
			$wp_cli . "menu item add-post main 3 --title=\"$blog\"",
			$wp_cli . "menu item add-post main 4 --title=\"$contact\"",
			$wp_cli . "menu item add-post footer 7 --title=\"$imprint\"",
			$wp_cli . "menu item add-post footer 8 --title=\"$privacy\"",


		];

		// Dummy data
		if(isset($this->config->dummy_data) && $this->config->dummy_data) {
			for ($i = 0; $i <= 15; $i++) {
				array_push($exec, $this->create_post("post", $this->faker->sentence(5), $this->get_text(20), 'publish'));
			}

			for ($i = 0; $i <= 15; $i++) {
				array_push($exec, $this->create_post("team", $this->faker->name(), $this->get_text(), 'publish'));
			}

			for ($i = 0; $i <= 10; $i++) {
				array_push($exec, $this->create_post("faq", $this->faker->sentence(5), $this->get_text(5), 'publish'));
			}

			for ($i = 0; $i <= 10; $i++) {
				array_push($exec, $this->create_post("lexicon", $this->faker->sentence(5), $this->get_text(5), 'publish'));
			}

			for ($i = 0; $i <= 10; $i++) {
				array_push($exec, $this->create_post("job", $this->faker->sentence(5), $this->get_text(5), 'publish'));
			}

		}

		// Enable plugins
		array_push($exec, $wp_cli . "plugin activate --all");

		// Loop all commands
		foreach ( $exec as $command ) {
			echo shell_exec( $command );
		}

		$this->setLanguage();
	}

	/**
	 * @param int $paragraphs
	 *
	 * @return string
     */
    protected function get_text($paragraphs=10) {
		$result = [];

		for ($i = 0; $i <= $paragraphs; $i++) {
			array_push($result, $this->faker->paragraph($this->faker->numberBetween(5,30)));
		}

		return implode("\n\n",$result);
	}

	/**
	 * @param $ype
	 * @param $title
	 * @param $content
	 * @param $status
	 *
	 * @return string
     */
    protected function create_post($ype, $title, $content, $status) {
		$wp_cli = $this->wp_cli;
		return $wp_cli . "post create --post_type=$ype --post_title='$title' --post_content='$content' --post_status='$status'";
	}

	/**
	 * Set Language
	 *
	 * @return mixed
	 */
	protected function setLanguage() {

		// Return output if there is no language set
		if ( !isset( $this->config->wordpress_language_key ) ) { return false; }

		$wp_cli = $this->wp_cli;
		return $wp_cli . "option add WPLANG \"{$this->config->wordpress_language_key}\"";
	}
}