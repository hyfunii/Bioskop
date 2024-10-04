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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id('rating_id');
            $table->foreignId('film_id');
            $table->foreignId('user_id');
            $table->integer('rating')->unsigned();
            $table->text('comment');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
    // public function down(): void
    // {
    //     Schema::table('ratings', function (Blueprint $table) {
    //         $table->dropForeign(['film_id']);
    //         $table->dropColumn('film_id');
    //     });
    // }
};
