<?php

namespace Caddy;

use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
	use Notifiable, Searchable, HasMediaTrait;

	/**
	 * Get the indexable data array for the model.
	 *
	 * @return array
	 */
	public function toSearchableArray()
	{
		return ['name' => $this->name];
	}

	public function registerMediaConversions(Media $media = null)
	{
		$this->addMediaConversion('article_poster')
			->width('64')
			->height('42');
	}

	public function registerMediaCollections()
	{
		$this->addMediaCollection('avatars');
	}

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	public function getAvatarAttribute()
	{
		return optional($this->getMedia('avatars')->first())->getUrl('article_poster');
	}

	public function getAvatarFullAttribute()
	{
		return optional($this->getMedia('avatars')->first())->getUrl();
	}

	public function articles()
	{
		return $this->hasMany(Article::class);
	}
}
