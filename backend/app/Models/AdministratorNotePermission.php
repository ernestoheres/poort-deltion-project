<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministratorNotePermission extends Model
{
    use HasFactory;

    protected $table = 'administrator_note_permission';

    protected $fillable = [
        'note_id',
        'administrator_id',
        'client_id',
    ];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

}
