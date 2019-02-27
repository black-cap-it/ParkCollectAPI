<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class parking extends Model
{
    protected $connection = 'mysql';
    protected $primaryKey = 'id';
    protected $table = 'parking';
    protected $fillable = [
        'userid',
        'xcord',
        'ycord',
        'parkplatz',
        'strab',
        'haus',
        'plz',
        'ort',
        'image',
        'image_enc'
    ];

}
