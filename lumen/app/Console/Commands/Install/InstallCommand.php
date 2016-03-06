<?php

namespace App\Console\Commands\Install;

use Illuminate\Console\Command;

/**
 * Class InstallCommand
 */
class InstallCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'wp-lumen:install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'The "wordpress-lumen" package installer.';

	/**
	 * Create a new command instance.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * The install components
	 *
	 * @var array
	 */
	protected $components = [
		\App\Console\Commands\Install\Components\ComponentWordpress::class,
		\App\Console\Commands\Install\Components\ComponentTheme::class,
		\App\Console\Commands\Install\Components\ComponentAssets::class,
		\App\Console\Commands\Install\Components\ComponentRobots::class,
		\App\Console\Commands\Install\Components\ComponentHtaccess::class,
		\App\Console\Commands\Install\Components\ComponentHtpasswd::class,
		\App\Console\Commands\Install\Components\ComponentScreenshot::class,
		\App\Console\Commands\Install\Components\ComponentStyleCss::class,
		\App\Console\Commands\Install\Components\ComponentWpConfig::class,
		\App\Console\Commands\Install\Components\ComponentBackupSettings::class,
		\App\Console\Commands\Install\Components\ComponentRemoveFiles::class,
		\App\Console\Commands\Install\Components\ComponentWpCli::class,
		\App\Console\Commands\Install\Components\ComponentLoadAssetsTools::class,
		\App\Console\Commands\Install\Components\ComponentSetFilesAndFolderPermission::class,
	];

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		foreach($this->components as $component) {
			(new $component)->fire();
		}
	}
}