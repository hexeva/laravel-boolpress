<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            // foreing key per tabella posts
           $table->unsignedBigInteger('post_id');
           $table->foreign('post_id')
                ->references('id')
                ->on('posts');

                 // foreing key per tabella tags
           $table->unsignedBigInteger('tag_id');
           $table->foreign('tag_id')
                ->references('id')
                ->on('tags');

                // rendo le 2 foreign_key primary
            $table->primary(['post_id','tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
