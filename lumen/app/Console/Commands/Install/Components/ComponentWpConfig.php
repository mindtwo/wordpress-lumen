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
			// Generate Custom WorPress Core "wp_config.php"-File.
			$this->generateCustomWorPressCoreWpConfigFile();

			// Generate WorPress Core "wp_config.php"-File.
			$this->generateWorPressCoreWpConfigFile();
		}
	}

	/**
	 * Generate Custom WorPress Core "wp_config.php"-File.
	 *
	 * @return mixed
	 */
	protected function generateCustomWorPressCoreWpConfigFile(  ) {
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
		$output = $this->setCookieDomainSupport( $output );
		$output = $this->setMultisiteSupport( $output );
		$output = $this->setComposerAutoloading( $output );
		$output = $this->removeWpSettingsFile( $output );

		// Write WordPress config file
		echo "Write \"{$this->public_dir}/wp-config.php\" file.\n";
		$this->filesystem->put( $this->public_dir . '/wp-config.php', $output );
		unset( $output );
	}


	/**
	 * Generate WorPress Core "wp_config.php"-File.
	 *
	 * @return mixed
	 */
	protected function generateWorPressCoreWpConfigFile() {
		echo "Generate WorPress Core \"wp_config.php\"-File.\n";
		$this->filesystem->put( $this->wp_dir . '/wp-config.php', '<?php

/** Absolute path to the WordPress directory. */
if ( !defined(\'ABSPATH\') )
    define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Location of your WordPress configuration. */
require_once(ABSPATH . \'../wp-config.php\');

/** Load WordPress settings file */
require_once(ABSPATH . \'wp-settings.php\');' );

	}


	/**
	 * Remove wp-settings.php link in config file
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	protected function removeWpSettingsFile( $output ) {
		echo "Remove wp-settings.php link in config file\n";
		$output = str_replace("require_once(ABSPATH . 'wp-settings.php');", "// require_once(ABSPATH . 'wp-settings.php');", $output);
		return $output;
	}


	/**
	 * Add database data
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	protected function setDatabaseSettings( $output ) {
		echo "WordPress database configuration\n";

		$output = preg_replace( '/(define\(\'DB_USER\', )(\'.+\')(\)\;)/', '${1}getenv(\'DB_USERNAME\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_PASSWORD\', )(\'.+\')(\)\;)/', '${1}getenv(\'DB_PASSWORD\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_HOST\', )(\'.+\')(\)\;)/', '${1}getenv(\'DB_HOST\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_NAME\', )(\'.+\')(\)\;)/', '${1}getenv(\'DB_DATABASE\')${3}', $output );
		$output = preg_replace( '/(define\(\'DB_CHARSET\', )(\'.+\')(\)\;)/', '${1}getenv(\'DB_CHARSET\')${3}', $output );

		return $output;
	}

	/**
	 * Set Composer autoloading to WordPress
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	protected function setComposerAutoloading( $output ) {
		echo "Set Composer autoloading to WordPress\n";

		$dotenv = "/** Autoload lumen system */\n";
		$dotenv .= "require_once(realpath(__DIR__ . '/../lumen/vendor/autoload.php'));\n";
		$dotenv .= "try {\n";
		$dotenv .= "	(new Dotenv\\Dotenv(__DIR__.'/../'))->load();\n";
		$dotenv .= "} catch (Dotenv\\Exception\\InvalidPathException \$e) {}\n";

		return str_replace( '<?php', "<?php\n$dotenv" . "\n", $output );
	}


	/**
	 * Enable/disable debug mode?
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	protected function setDebug( $output ) {
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
	protected function setWordpressDirectory( $output ) {
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
	protected function setPhpErrorLoggingInDebugMode( $output ) {
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
	protected function setSalts( $output ) {
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
	protected function setPostRevisions( $output ) {
		if ( isset( $this->config->post_revisions ) ) {
			echo "WordPress post_revisions mode disabled\n";

			return str_replace( '<?php', "<?php\n
/** Disable Post Revisions */
define('WP_POST_REVISIONS', " . ( boolval( $this->config->post_revisions ) ? 'true' : 'false' ) . ");" . "\n", $output );
		}

		return $output;
	}

	/**
	 * Add Wordpress cookie domain support
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	protected function setCookieDomainSupport( $output ) {
		echo "Add Wordpress cookie domain support\n";
		return str_replace( '<?php', "<?php\n
/** WordPress cookie domain settings */
define('ADMIN_COOKIE_PATH', '/');
define('COOKIEPATH', '');
define('SITECOOKIEPATH', '');
define('COOKIE_DOMAIN', false);" . "\n", $output );
	}

	/**
	 * Enable/disable wordpress multisite?
	 *
	 * @param $output
	 *
	 * @return mixed
	 */
	protected function setMultisiteSupport( $output ) {
		if ( isset( $this->config->multisite->status ) && $this->config->multisite->status == true ) {

			echo "Add Wordpress multisite support\n";

			return str_replace( '<?php', "<?php\n
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
	protected function setTrashCleanup( $output ) {
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
	protected function setDisallowFileEdit( $output ) {
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
	protected function setDifferentWpContentDirectory( $output ) {
		echo "Change WordPress wp-content directory\n";
		$output = str_replace( '<?php', "<?php\n
/** Change WordPress wp-content directory */
define( 'WP_PROTOCOL',  stripos(\$_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://' );
define( 'WP_FULL_URL',  (isset(\$_SERVER['HTTP_HOST'])) ? WP_PROTOCOL . \$_SERVER['HTTP_HOST'] : '" . $this->config->wordpress_install->wordpress_primary_domain . "' );
define( 'WP_SITEURL', WP_FULL_URL . '/wordpress' );
define( 'WP_HOME', WP_FULL_URL );
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
	protected function setWpAutoUpdate( $output ) {
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
	protected function setPostAutosaveInterval( $output ) {
		if ( isset( $this->config->autosave_interval_in_seconds ) ) {
			echo "Modify AutoSave Interval\n";

			return str_replace( '<?php', "<?php\n
/** Modify AutoSave Interval */
define( 'AUTOSAVE_INTERVAL', {$this->config->autosave_interval_in_seconds} );" . "\n", $output );
		}

		return $output;
	}
}