<?php

namespace Caddy;

use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Member extends Model implements HasMedia
{
    use HasMediaTrait;

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('avatar')
                ->width('368')
                ->height('246');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatars');
    }

    public function getAvatarAttribute()
    {
        return optional($this->getMedia('avatars')->first())->getUrl('avatar');
    }

    /**
     * Social Accounts Relationship
     *
     * Defines a relationship where a Member
     * Can have multiple social accounts
     *
     * @return type
     **/
    public function socialAccounts()
    {
        return $this->belongsToMany(SocialAccount::class)->withPivot(['url']);
    }
}
