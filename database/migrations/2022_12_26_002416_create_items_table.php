<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->string('title');
            $table->string('slug');
            $table->enum('item_type', [1 => 'single item', 2 => 'episode item']);
            $table->string('preview_text');
            $table->text('description');
            $table->text('genre');
            $table->string('status');
            $table->text('portrait');
            $table->text('landscape');
            $table->string('director');
            $table->string('studio');
            $table->string('network');
            $table->string('countri');
            $table->integer('episode');
            $table->string('duration');
            $table->boolean('featured');
            $table->double('rates');
            $table->integer('view');
            $table->date('release_date');

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
        Schema::dropIfExists('items');
    }
};
