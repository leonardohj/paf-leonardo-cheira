<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedingLog extends Model
{
    protected $table = 'feeding_log';

    public $timestamps = false;

    protected $fillable = [
        'id_feeder',
        'quantity',
        'status',
        'notes',
        'date'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function feeder()
    {
        return $this->belongsTo(Feeder::class, 'id_feeder');
    }
}