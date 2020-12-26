<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\{HasMedia, InteractsWithMedia};

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
