<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;
class WhitelistedEmail extends Model
{
    use HasFactory;
    use Encryptable;

    protected $encryptable = [
        'email',
        'role',
        'one_time_password',
    ];

    protected $fillable = [
        'email',
        'granted_by',
        'role',
        'one_time_password',
    ];
}
