<?php

namespace Caddy;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use Searchable;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPosterAvatarAttribute()
    {
        return $this->user->avatar;
    }

    public function getPosterAvatarFullAttribute()
    {
        return $this->user->avatarFull;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only(['title', 'body', 'excerpt', 'image', 'slug']);
        return $array;
    }

    /**
     * Get route key name
     *
     * Get the column name used to retrieve articles
     *
     * @return string Key name
     **/
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
