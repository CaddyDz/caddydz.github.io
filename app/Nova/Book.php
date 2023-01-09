<?php

declare(strict_types=1);

namespace App\Nova;

use App\Models\Book as BookModel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{ID, KeyValue, Text};
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;

class Book extends Resource
{
	/**
	 * The model the resource corresponds to.
	 *
	 * @var string
	 */
	public static $model = \App\Models\Book::class;

	/**
	 * The single value that should be used to represent the resource when being displayed.
	 *
	 * @var string
	 */
	public static $title = 'title';

	/**
	 * The columns that should be searched.
	 *
	 * @var array
	 */
	public static $search = [
		'title', 'links'
	];

	/**
	 * Get a fresh instance of the model represented by the resource.
	 *
	 * @return \App\Models\Book $book
	 */
	public static function newModel(): BookModel
	{
		$model = static::$model;
		$book = new $model();
		// Set the dafault value for the file formats
		$book->links = ['pdf' => '', 'epub' => '', 'audio' => ''];
		return $book;
	}

	/**
	 * Get the fields displayed by the resource.
	 *
	 * @param \Laravel\Nova\Http\Requests\NovaRequest $request
	 *
	 * @return array
	 */
	public function fields(NovaRequest $request)
	{
		return [
			ID::make('id')->sortable(),
			Text::make('Title')
				->rules('required', 'string', 'max:254')
				->creationRules('unique:books,title')
				->updateRules('unique:books,title,{{resourceId}}'),
			KeyValue::make('Links')
				->rules('json')
				->keyLabel('Format')
				->valueLabel('Link')
				->disableAddingRows()
				->disableEditingKeys()
				->disableDeletingRows(),
			Files::make('Files', 'files')->setFileName(fn ($originalFilename, $extension, $model) =>
			str_slug($model->title) . '.' . $extension),
		];
	}
}
