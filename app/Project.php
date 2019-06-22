<?php

namespace Caddy;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
