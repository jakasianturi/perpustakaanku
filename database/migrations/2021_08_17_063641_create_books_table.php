<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('book_id')->unique();
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories')->unsigned();
            $table->foreignId('bookshelf_id')->constrained('bookshelves')->unsigned();
            $table->string('title');
            $table->string('author');
            $table->string('isbn');
            $table->string('publisher');
            $table->string('publication');
            $table->integer('stock');
            $table->longText('description');
            $table->string('cover');
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('books');
    }
}