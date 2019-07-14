<?php

namespace Caddy\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Textarea;
use Benjaminhirsch\NovaSlugField\Slug;
use Benjaminhirsch\NovaSlugField\TextWithSlug;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'Caddy\Article';

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
        'title', 'excerpt', 'body',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            TextWithSlug::make('Title')->sortable()
                ->rules('required', 'min:3', 'max:50')
                ->slug('slug'),
            // BelongsTo::make('Category')->searchable(),
            Trix::make('Body'),
            Textarea::make('Excerpt'),
            Image::make('Image'),
            Slug::make('Link', 'slug')->hideFromIndex()
                ->showUrlPreview(config('app.url'))
                ->rules('required', 'min:3', 'max:50'),
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
