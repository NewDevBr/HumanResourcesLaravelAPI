<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string("pathPhoto", 100);
            $table->string("name", 45);
            $table->string("post", 50);
            $table->string("email", 45)->unique();
            $table->string("password");
            $table->unsignedBigInteger("created_by_admin")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table("admins", function(Blueprint $table){
            $table->foreign("created_by_admin")->references("id")->on("admins")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
