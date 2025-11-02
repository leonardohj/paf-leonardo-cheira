<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{    
    protected $rules = [
        'nome' => 'required|string|max:255',
        'status' => 'required|string|max:255',
    ];

    protected $table = 'feeder';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id_user',
        'nome',
        'code'
    ];
    public $timestamps = false;
}