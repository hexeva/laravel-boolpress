<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->string('phone',15);
            $table->string('address',255);
            // creo la foreign key 
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // specifico che uder_id deve essere una foreign key:
            $table->foreign('user_id')
            // che fa riferimento all'id della tabella principale()
                  ->references('id')
            // che punta alla tabella di riferimento users
                  ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_info');
    }
}
