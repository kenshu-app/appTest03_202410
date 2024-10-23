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
        Schema::create('books', function (Blueprint $table)
        {
        $table->id();
        $table->bigInteger('user_id')->unsigned()->index();
        $table->string('title', 30);
        $table->string('author', 20)->default('著者不明');
        $table->string('publisher', 20)->default('出版社不明');
        $table->text('review')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
