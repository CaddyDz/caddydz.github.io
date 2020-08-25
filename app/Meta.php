<?php

namespace Caddy;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Meta extends Model
{
	use HasTranslations;
	
	public $translatable = ['content'];
}
