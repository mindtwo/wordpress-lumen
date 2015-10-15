<?php

namespace App\Console\Commands\Install\Components;


/**
 * Class ComponentWpConfig
 */
class ComponentWpConfig extends ComponentBase implements WpInstallComponentsInterface {

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
		if ( ! $this->filesystem->exists( $this->public_dir . '/wp-config.php' ) && $this->filesystem->exists( $this->wp_dir . '/wp-config-sample.php' ) ) {

			// Load wp-config-sample.php file
			$output = $this->filesystem->get( $this->wp_dir . '/wp-config-sample.php' );

			// Run replacements and add some additional constants
			$output = $this->setDebug( $output );
			$output = $this->setWordpressDirectory( $output );
			$output = $this->setPhpErrorLoggingInDebugMode( $output );
			$output = $this->setDatabaseSettings( $output );
			$output = $this->setSalts( $output );
			$output = $this->setPostRevisions( $output );
			$output = $this->setTrashCleanup( $output );
			$output = $this->setDisallowFileEdit( $output );
			$output = $this->setWpAutoUpdate( $output );
			$output = $this->setDifferentWpContentDirectory( $output );
			$output = $this->setPostAutosaveInterval( $output );
			$output = $this->setMultisiteSupport( $output );
			$output = $this->setLanguage( $output );
			$output = $this->setComposerAutoloading( $output );
			$output = $this->removeWpSettingsFile( $output );

			// Write WordPress config file
			echo "Write \"{$this->public_dir}/wp-config.php\" file.\n";
			$this->filesystem->put( $this->public_dir . '/wp-config.php', $output );
			$this->filesystem->put( $this->wp_dir . '/wp-config.php', '<?php

/** Absolute path to the WordPress directory. */
if ( !defined(\'ABSPATH\') )
    define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Location of your WordPress configuration. */
require_once(ABSPATH . \'../wp-config.php\');

/** Load WordPress settings file */
require_once(ABSPATH . \'wp-settings.php\');' );
			unset( $output );
		}
	}


	/**
	 * Remove wp-settings.php link in config file
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function removeWpSettingsFile( $output ) {
		echo "Remove wp-settings.php link in config file\n";
		$output = preg_replace( '/\n\/\*\*.+\*\/\nrequire_once\(ABSPATH \. \'wp-settings\.php\'\);\n/', '', $output );
		return $output;
	}


	/**
	 * Add database data
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setDatabaseSettings( $output ) {
		echo "WordPress database configuration\n";
		$output = preg_replace( '/(define\(\'DB_USER\', )(\'.+\')(\)\;)/', '${1}Dotenv::findEnvironmentVariable(\'DB_USERNAME\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_PASSWORD\', )(\'.+\')(\)\;)/', '${1}Dotenv::findEnvironmentVariable(\'DB_PASSWORD\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_HOST\', )(\'.+\')(\)\;)/', '${1}Dotenv::findEnvironmentVariable(\'DB_HOST\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_NAME\', )(\'.+\')(\)\;)/', '${1}Dotenv::findEnvironmentVariable(\'DB_DATABASE\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_CHARSET\', )(\'.+\')(\)\;)/', '${1}Dotenv::findEnvironmentVariable(\'DB_CHARSET\')${3}', $output );

		return $output;
	}

	/**
	 * Set Composer autoloading to WordPress
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setComposerAutoloading( $output ) {
		echo "Set Composer autoloading to WordPress\n";

		return str_replace( '<?php', "<?php\n
/** Autoload lumen system */
require_once(realpath(__DIR__ . '/../lumen/vendor/autoload.php'));
Dotenv::load(__DIR__.'/../lumen/');" . "\n", $output );
	}


	/**
	 * Enable/disable debug mode?
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setDebug( $output ) {
		if ( isset( $this->config->debug ) && $this->config->debug == true ) {
			echo "WordPress debug mode enabled\n";
			return str_replace( 'define(\'WP_DEBUG\', false);', 'define(\'WP_DEBUG\', true);', $output );
		}

		return $output;
	}


	/**
	 * Set WordPress directory
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setWordpressDirectory( $output ) {
		echo "Set WordPress directory\n";
		return str_replace( 'define(\'ABSPATH\', dirname(__FILE__) . \'/\');', 'define(\'ABSPATH\', dirname(__FILE__) . \'/wordpress/\' );', $output );

		return $output;
	}


	/**
	 * Enable PHP error logging in debug mode
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setPhpErrorLoggingInDebugMode( $output ) {
		echo "Enable PHP error logging in debug mode\n";

		return preg_replace( "/(define\(\s*?'WP_DEBUG'\s*?,\s*?(false|true)\s*?\);)/", "$1\n
/** Enable PHP Errors */
if(WP_DEBUG) {
	define('SAVEQUERIES', true);
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}\n", $output );
	}


	/**
	 * Set secret salts in config.php (https://api.wordpress.org/secret-key/1.1/salt/)
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setSalts( $output ) {
		echo "Write secret salts to \"/public/wp_config.php\" file\n";
		$wp_secure_keys = array(
			'AUTH_KEY',
			'SECURE_AUTH_KEY',
			'LOGGED_IN_KEY',
			'NONCE_KEY',
			'AUTH_SALT',
			'SECURE_AUTH_SALT',
			'LOGGED_IN_SALT',
			'NONCE_SALT'
		);

		foreach ( $wp_secure_keys as $key ) {
			$salt = str_replace( '$', '', password_hash( time() . uniqid(), PASSWORD_BCRYPT ) . password_hash( uniqid() . time(), PASSWORD_BCRYPT ) );
			$output = preg_replace( "/(define\(\'" . $key . "\',.+\')(.+)(\'\)\;)/", '${1}' . $salt . '$3', $output );
		}

		return $output;
	}


	/**
	 * Enable/disable post_revisions mode?
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setPostRevisions( $output ) {
		if ( isset( $this->config->post_revisions ) ) {
			echo "WordPress post_revisions mode disabled\n";

			return str_replace( '<?php', "<?php\n
/** Disable Post Revisions */
define('WP_POST_REVISIONS', " . ( boolval( $this->config->post_revisions ) ? 'true' : 'false' ) . ");" . "\n", $output );
		}

		return $output;
	}


	/**
	 * Enable/disable wordpress multisite?
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setMultisiteSupport( $output ) {
		if ( isset( $this->config->multisite->status ) && $this->config->multisite->status == true ) {

			echo "Add Wordpress multisite support\n";

			return str_replace( '<?php', "<?php\n
/** Cookie multisite settings */
define('ADMIN_COOKIE_PATH', '/');
define('COOKIEPATH', '');
define('SITECOOKIEPATH', '');
define('COOKIE_DOMAIN', false);


/** Multisite configuration */
define('WP_ALLOW_MULTISITE', true);
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', '" . $this->config->multisite->primary_host . "');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);" . "\n", $output );
		}

		return $output;
	}


	/**
	 * Empty Trash in days
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setTrashCleanup( $output ) {
		if ( isset( $this->config->empty_trash_in_days ) ) {
			echo "WordPress empty trash in " . $this->config->empty_trash_in_days . " days enabled.\n";

			return str_replace( '<?php', "<?php\n
/** Empty WordPress trash in */
define( 'EMPTY_TRASH_DAYS', {$this->config->empty_trash_in_days} );" . "\n", $output );
		}

		return $output;
	}


	/**
	 * Disable the Plugin and Theme Editor
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setDisallowFileEdit( $output ) {
		if ( isset( $this->config->disallow_file_edit ) ) {
			echo "WordPress post_revisions mode disabled\n";
			$output = str_replace( '<?php', "<?php\n
/** Disable the Plugin and Theme Editor */
define( 'DISALLOW_FILE_EDIT', " . ( boolval( $this->config->disallow_file_edit ) ? 'true' : 'false' ) . " );" . "\n", $output );
		}

		return $output;
	}


	/**
	 * Change WordPress wp-content directory
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setDifferentWpContentDirectory( $output ) {
		echo "Change WordPress wp-content directory\n";
		$output = str_replace( '<?php', "<?php\n
/** Change WordPress wp-content directory */
define( 'WP_PROTOCOL',  stripos(\$_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' );
define( 'WP_FULL_URL',  (isset(\$_SERVER['HTTP_HOST'])) ? WP_PROTOCOL . \$_SERVER['HTTP_HOST'] : '" . $this->config->wordpress_install->wordpress_primary_domain . "' );
define( 'WP_SITEURL', WP_FULL_URL . '/wordpress' );
define( 'WP_HOME', WP_FULL_URL );
define( 'UPLOADS', '/content/uploads/' );
define( 'WP_CONTENT_URL', WP_FULL_URL . '/content' );
define( 'WP_CONTENT_DIR', realpath( dirname( __FILE__ ) . '/content' ) );" . "\n", $output );
		return $output;
	}


	/**
	 * Disable WordPress Auto Updates
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setWpAutoUpdate( $output ) {
		if ( isset( $this->config->disable_all_automatic_updates ) ) {
			echo "WordPress post_revisions mode disabled\n";

			return str_replace( '<?php', "<?php\n
/** Disable all automatic updates */
define( 'AUTOMATIC_UPDATER_DISABLED', " . ( boolval( $this->config->disable_all_automatic_updates ) ? 'true' : 'false' ) . " );" . "\n", $output );
		}

		return $output;
	}


	/**
	 * Modify AutoSave Interval
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setPostAutosaveInterval( $output ) {
		if ( isset( $this->config->autosave_interval_in_seconds ) ) {
			echo "Modify AutoSave Interval\n";

			return str_replace( '<?php', "<?php\n
/** Modify AutoSave Interval */
define( 'AUTOSAVE_INTERVAL', {$this->config->autosave_interval_in_seconds} );" . "\n", $output );
		}

		return $output;
	}


	/**
	 * Set Language
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	private function setLanguage($output) {

		// Return output if there is no language set
		if ( !isset( $this->config->wordpress_language_key ) ) { return $output; }

		// Update WPLANG
		if (strpos($output,'WPLANG') !== false) {
			echo "Update language in wp-config.php file\n";
			return preg_replace( '/(define\(\'WPLANG\', )(\'.+\')(\)\;)/', '${1}\'' . $this->config->wordpress_language_key . '\'${3}', $output );
		}

		// Set WPLANG if not exists
		echo "Set language in wp-config.php file\n";
		return str_replace( '<?php', "<?php\n
/** WordPress Translation */
define('WPLANG', '{$this->config->wordpress_language_key}');" . "\n", $output );
	}
}