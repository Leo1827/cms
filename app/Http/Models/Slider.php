<?php

namespace App\http\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $hidden = ['created_at', 'update_at'];
}
