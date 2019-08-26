<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_uploaded_file_id')->unsigned();
            $table->string('name', 50);
            $table->timestamps();

            $table->foreign('user_uploaded_file_id')->references('id')->on('user_uploaded_files')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_tags');
    }
}
