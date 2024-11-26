<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('userAccounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('userName');

            // each userAccount has one User(username,password)
            $table -> unsignedBigInteger('userId');
            $table->foreign('userId')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');

            // each userAccount has many posts
            $table->unsignedBigInteger('postId');
            $table->foreign('postId')->references('id')->on('posts')
            ->onDelete('cascade')->onUpdate('cascade');
            
            // each userAccount has many comments
            $table->unsignedBigInteger('commentId');
            $table->foreign('commentId')->references('id')->on('comments')
            ->onDelete('cascade')->onUpdate('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userAccounts');
    }
};
