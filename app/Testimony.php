<?php

namespace Caddy;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Testimony extends Model implements HasMedia
{
	use HasMediaTrait;

	public function registerMediaConversions(Media $media = null)
	{
		$this->addMediaConversion('avatar')
				->width('150')
				->height('100');
		$this->addMediaConversion('thumb')
				->width('67')
				->height('44');
	}

	public function registerMediaCollections()
	{
		$this->addMediaCollection('avatars');
	}

	public function getEndorserNameAttribute()
	{
		$name = str_before($this->endorser, ' -');
		return $name;
	}

	public function getEndorserCompanyAttribute()
	{
		$name = str_after($this->endorser, '- ');
		return $name;
	}
	// Avatar & thumb
}
