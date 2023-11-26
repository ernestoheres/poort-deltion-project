<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Encryptable;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Encryptable;

    protected $encryptable = [
        'voornaam',
        'tussenvoegels',
        'achternaam',
        'adres',
        'postcode',
        'woonplaats',
        'land',
        'telefoon',
        'bsn',
        'vezekering',
        'polisnummer',
       
  
    ];
   


    protected $fillable = [
       'voornaam',
       'tussenvoegels',
       'achternaam',
       'adres',
       'postcode',
       'woonplaats',
       'land',
       'telefoon',
       'bsn',
       'vezekering',
       'polisnummer',
        'geslacht',
        'bloedtype',
       'profielfoto',
       'user_id',
    ];

}
