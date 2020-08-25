<?php

use Caddy\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProjectsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Storage::disk('public')->deleteDirectory('projects');
		Storage::disk('public')->makeDirectory('projects');
		factory(Project::class, 6)->create()->each(function($project) {
			$project->addMedia($project->screenshots)->toMediaCollection('thumbs');
		});
	}
}
