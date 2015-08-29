<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Class RefreshDotenvFileCommand
 */
class RefreshDotenvFileCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'wp-lumen:refresh-dotenv-file';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Refresh dotenv file from /install/config/install-config.json';

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
		\App\Console\Commands\Install\Components\ComponentDotenvFile::class,
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