<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [''];

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function detail_schedule()
    {
        return $this->hasMany(DetailSchedule::class, 'team_id' , 'id');
    }
}
