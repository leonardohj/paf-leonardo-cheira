<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feeder extends Model
{
    protected $table = 'feeder';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'name',
        'status',
        'code',
        'pet_type',
        'last_fed_at'
    ];

    protected $casts = [
        'last_fed_at' => 'date'
    ];

    // Relationships

    public function feedingLogs()
    {
        return $this->hasMany(FeedingLog::class, 'id_feeder');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'id_feeder');
    }

    // Belongs to User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}