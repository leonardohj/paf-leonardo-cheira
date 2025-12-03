<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedingLog extends Model
{
    protected $table = 'feeding_log';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_feeder',
        'date',
        'hour',
        'quantity',
        'status',
        'notes',
    ];

    public $timestamps = true;

    public function feeder()
    {
        return $this->belongsTo(Feeder::class, 'id_feeder', 'id');
    }
}
