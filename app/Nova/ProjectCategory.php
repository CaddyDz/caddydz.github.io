<?php

declare(strict_types=1);

namespace App\Nova;

use Laravel\Nova\Fields\{ID, Text};
use Laravel\Nova\Http\Requests\NovaRequest;

class ProjectCategory extends Resource
{
	/**
	 * The model the resource corresponds to.
	 *
	 * @var class-string<\App\Models\ProjectCategory>
	 */
	public static $model = \App\Models\ProjectCategory::class;

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'name';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'id', 'name',
	];

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
	 * @return array
	 */
	public function fields(NovaRequest $request)
	{
		return [
			ID::make()->sortable(),
			Text::make()->sortable(),
		];
	}
}
