<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory;
    protected $fillable = [
        'voornaam',
        'achternaam',
        'btijd',
        'etijd',
        'datum',
        'doctor'
    ];
}
