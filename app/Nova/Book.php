<?php

declare(strict_types=1);

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\KeyValue;
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
	 */
	public static function newModel()
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
	 * @param \Illuminate\Http\Request $request
	 * @return array
	 */
	public function fields(Request $request)
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

	/**
	 * Get the cards available for the request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function cards(Request $request)
	{
		return [];
	}

	/**
	 * Get the filters available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function filters(Request $request)
	{
		return [];
	}

	/**
	 * Get the lenses available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function lenses(Request $request)
	{
		return [];
	}

	/**
	 * Get the actions available for the resource.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array
	 */
	public function actions(Request $request)
	{
		return [];
	}
}
