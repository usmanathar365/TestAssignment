<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rack_id')->unsigned();
            $table->string('title',50)->nullable();
            $table->string('author',50)->nullable();
            $table->string('published_year',50)->nullable();
           
            $table->timestamps();
        });
        Schema::table('books', function($table) {
        $table->foreign('rack_id')->references('id')->on('racks')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
