<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')
                ->constrained('schedules')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('team_id')
                ->constrained('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('player_id')
                ->constrained('players')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('goal_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_schedules', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('detail_schedules');
    }
}
