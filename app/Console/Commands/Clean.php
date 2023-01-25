<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Foundation\Console\{ClearCompiledCommand, OptimizeClearCommand};

class Clean extends Command
{
	/** @var array $files List of files to delete */
	private array $files = [
		'.php-cs-fixer.cache',
		'_ide_helper.php',
		'.phpstorm.meta.php',
		'.phpunit.result.cache',
		'storage/logs/laravel.log',
		'.DS_Store',
	];

	/** @var array $command Cleanup commands to run */
	private array $commands = [
		ClearCompiledCommand::class,
		OptimizeClearCommand::class,
		'debugbar:clear',
	];

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'clean';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Delete temporary files';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle(): int
	{
		foreach ($this->files as $file) {
			File::delete($file);
		}
		foreach ($this->commands as $command) {
			$this->callSilent($command);
		}
		return 0;
	}
}
