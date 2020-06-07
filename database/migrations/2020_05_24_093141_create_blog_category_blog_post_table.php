<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoryBlogPostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_category_blog_post', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('blog_category_id')->unsigned();
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
            $table->bigInteger('blog_post_id')->unsigned();
            $table->foreign('blog_post_id')->references('id')->on('blog_posts')->onDelete('cascade');
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
        Schema::table('blog_category_blog_post', function (Blueprint $table) {
            $table->dropForeign('blog_category_blog_post_blog_category_id_foreign');
            $table->dropForeign('blog_category_blog_post_blog_post_id_foreign');
        });

        Schema::dropIfExists('blog_category_blog_post');
    }
}
