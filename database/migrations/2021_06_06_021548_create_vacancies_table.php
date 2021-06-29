<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->string('description', 3500);
            $table->boolean('remote');
            $table->enum('hiring',['CLT','PJ','CLT/PJ', 'Internship']);
            $table->foreignId('admin_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('vacancies', function (Blueprint $table) {
            $table->foreign('admin_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
