<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class complaints extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'complaints';
    protected $fillable = [
        'userid',
        'xcord',
        'ycord',
        'zeitpunkt',
        'parkplatz',
        'grund',
        'tarif',
        'telefon',
        'image',
        'image_enc'
    ];
}
