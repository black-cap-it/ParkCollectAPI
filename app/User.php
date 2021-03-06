<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'image',
        'nutzung',
        'anrede',
        'firma',
        'vorname',
        'nachname',
        'strabe',
        'haus',
        'plz',
        'ort',
        'telefon',
        'account_holder',
        'iban',
        'signature',
        'agree',
        'remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        //  'remember_token',
    ];
}
