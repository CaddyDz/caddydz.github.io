<?php

namespace Caddy;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Project extends Model implements HasMedia
{
	use HasMediaTrait;

	public function getRouteKeyName()
	{
		return 'slug';
	}

	public function registerMediaConversions(Media $media = null)
	{
		$this->addMediaConversion('thumb')
				->width('400')
				->height('266');
	}

	public function registerMediaCollections()
	{
		$this->addMediaCollection('thumbs');
	}
}
