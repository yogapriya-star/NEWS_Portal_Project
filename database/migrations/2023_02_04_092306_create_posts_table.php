<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('sub_category_id');
          $table->string('post_title');
          $table->text('post_detail');
          $table->integer('visitors');
          $table->unsignedBigInteger('author_id');
          $table->unsignedBigInteger('admin_id');
          $table->integer('is_share');
          $table->integer('is_comment');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
