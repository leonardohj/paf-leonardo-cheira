<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $table = 'feeder';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'nome',
        'code',
        'status',
        'location',
        'pet_type',
        'last_fed_at',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_feeder', 'id');
    }

    public function feedingLogs()
    {
        return $this->hasMany(FeedingLog::class, 'id_feeder', 'id');
    }
}
