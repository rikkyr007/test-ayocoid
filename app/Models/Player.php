<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function detail_schedule()
    {
        return $this->hasMany(DetailSchedule::class, 'player_id', 'id');
    }
}
