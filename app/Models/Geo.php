<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Malhal\Geographical\Geographical;

class Geo extends Model
{
    use Geographical;

    protected $table = 'geos';

    protected $fillable = ['name', 'longitude', 'latitude'];

    protected static $kilometers = true;
}
