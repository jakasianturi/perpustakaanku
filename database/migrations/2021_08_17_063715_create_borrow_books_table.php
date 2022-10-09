<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->unsigned();
            $table->foreignId('user_id')->constrained('users')->unsigned();
            $table->date('borrow_date')->nullable();
            $table->date('return_date')->nullable();
            $table->integer('total')->nullable();
            $table->enum('status', ['Belum Disetujui', 'Aktif', 'Diperpanjang', 'Selesai'])->nullable()->default('Belum Disetujui');
            $table->date('returned_date')->nullable();
            $table->integer('book_fine')->nullable();
            $table->softDeletes('deleted_at')->nullable();
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
        Schema::dropIfExists('borrow_books');
    }
}