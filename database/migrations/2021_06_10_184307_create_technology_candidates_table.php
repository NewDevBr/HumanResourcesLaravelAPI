<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologyCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology_candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id');
            $table->foreignId('technology_id');
            $table->timestamps();
        });

        Schema::table('technology_candidates', function (Blueprint $table) {
            $table->foreign('candidate_id')->references('id')->on('candidates');
            $table->foreign('technology_id')->references('id')->on('technologies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technology_candidates');
    }
}
