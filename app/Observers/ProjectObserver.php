<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Project;
use Illuminate\Support\Str;

class ProjectObserver
{
	/**
	 * Handle the Project "saving" event.
	 *
	 * @param \App\Models\Project $project
	 *
	 * @return void
	 */
	public function saving(Project $project): void
	{
		$project->excerpt = Str::excerpt('');
	}

	/**
	 * Handle the Project "created" event.
	 *
	 * @param \App\Models\Project $project
	 *
	 * @return void
	 */
	public function created(Project $project): void
	{
		//
	}

	/**
	 * Handle the Project "updated" event.
	 *
	 * @param \App\Models\Project $project
	 *
	 * @return void
	 */
	public function updated(Project $project): void
	{
		//
	}

	/**
	 * Handle the Project "deleted" event.
	 *
	 * @param \App\Models\Project $project
	 *
	 * @return void
	 */
	public function deleted(Project $project): void
	{
		//
	}

	/**
	 * Handle the Project "restored" event.
	 *
	 * @param \App\Models\Project $project
	 *
	 * @return void
	 */
	public function restored(Project $project): void
	{
		//
	}

	/**
	 * Handle the Project "force deleted" event.
	 *
	 * @param \App\Models\Project $project
	 *
	 * @return void
	 */
	public function forceDeleted(Project $project): void
	{
		//
	}
}
