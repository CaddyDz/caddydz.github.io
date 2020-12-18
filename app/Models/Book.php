<?php

declare(strict_types=1);

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model implements HasMedia
{
	use HasFactory, InteractsWithMedia;

	protected $casts = [
		'links' => 'array'
	];

	public function getRouteKeyName(): string
	{
		return 'slug';
	}

	public function registerMediaCollections(): void
	{
		$this->addMediaCollection('files');
	}
}
