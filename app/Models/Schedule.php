<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id', 'id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(DetailSchedule::class);
    }
}
