<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unique_record_number',50)->index();
            $table->string('cso_name',120)->index();
            $table->text('location')->nullable();
            $table->date('post_date');
            $table->string('post_time');
            $table->integer('post_type_id');
            $table->integer('district_id');
            $table->text('details')->nullable();
            $table->text('response_actions')->nullable();
            $table->string('responder_name',120)->nullable();
            $table->text('feedback_on_response')->nullable();
            $table->text('additional_follow_up')->nullable();
            $table->softDeletes();
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
}
