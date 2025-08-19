<?php

namespace ChrisReedIO\FilamentOAuthClients\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birthdate',
    ];

    protected $casts = [
        'birthdate' => 'date',
    ];
}
