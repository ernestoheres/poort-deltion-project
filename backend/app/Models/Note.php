<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class Note extends Model
{
    use HasFactory;
    use Encryptable;

    protected $encryptable = [
        'content',
    ];
    
    protected $fillable = [
        'content',
        'client_id',
    ];
}
