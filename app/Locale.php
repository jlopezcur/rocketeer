<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    public $incrementing = false;
    protected $table = 'locales';
    protected $fillable = ['id', 'name'];
}
