<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $status = config('status');

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            // $table->string('status');
            $table->string('title');
            // $table->config('status')->default('Draft');
            $table->text('abstract');
            $table->text('contents');
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
        });

        //Aggiungi role_id in users
    //     Schema::table('users', function (Blueprint $table) {
    //     $table->unsignedBigInteger('role_id');

    //     $table->foreignId('role_id')->references('role_id')->on('model_has_roles');
    // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
