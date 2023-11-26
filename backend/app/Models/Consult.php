<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;


class Consult extends Model
{
    use HasFactory;
    use Encryptable;

    protected $encryptable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'btijd',
        'etijd',
        'datum',
        'doctor'
    ];
    protected $fillable = [
        'voornaam',
        'tussenvoegsel',
        'achternaam',
        'btijd',
        'etijd',
        'datum',
        'doctor'
    ];
}
