<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Consult extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'btijd',
        'etijd',
        'datum',
        'doctor'
    ];
}
