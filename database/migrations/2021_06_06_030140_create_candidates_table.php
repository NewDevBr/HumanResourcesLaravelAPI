<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string("pathPhoto");
            $table->string("name", 45);
            $table->string("titration", 45);
            $table->date("birthDate");
            $table->string("email", 45);
            $table->string("password");
            $table->string("github");
            $table->string("linkedin");
            $table->datetime("email_verified_at")->nullable();
            $table->boolean("notify_email")->default('0');;
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
        Schema::dropIfExists('candidates');
    }
}
