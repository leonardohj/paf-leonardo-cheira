<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    
    protected $primaryKey = 'id';

    protected $rules = [
        'id_feeder' => 'required|int|max:255',
        'time' => 'required|time|max:255',
    ];

    protected $fillable = [
        'id_feeder',
        'time',
    ];
    public $timestamps = false;
}