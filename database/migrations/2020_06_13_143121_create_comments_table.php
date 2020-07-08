<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('post_id')->unsigned();
            $table->bigInteger('user_id')->default(0);
            $table->string('name');
            $table->string('email');
            $table->text('comment');

            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->foreign('post_id')->references('id')->on('blog_posts');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('comments');
    }
}
