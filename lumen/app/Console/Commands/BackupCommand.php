<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class BackupCommand
 */
class BackupCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'wp-lumen:backup';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Peformes a filesystem and database backup.';

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
		\App\Console\Commands\Install\Components\ComponentBackup::class,
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