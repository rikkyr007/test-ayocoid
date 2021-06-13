<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team1_id')
                ->constrained('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('team2_id')
                ->constrained('teams')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('team1_type');
            $table->string('team2_type');
            $table->string('team1_score')->nullable();
            $table->string('team2_score')->nullable();
            $table->date('date');
            $table->time('time');
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
        Schema::table('schedules', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('schedules');
    }
}
