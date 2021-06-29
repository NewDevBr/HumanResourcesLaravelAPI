<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologyVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology_vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technology_id');
            $table->unsignedBigInteger('vacancy_id');
            $table->timestamps();
        });
        Schema::table('technology_vacancies', function (Blueprint $table) {
            $table->foreign('technology_id')->references('id')->on('technologies');
            $table->foreign('vacancy_id')->references('id')->on('vacancies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technology_vacancies');
    }
}
