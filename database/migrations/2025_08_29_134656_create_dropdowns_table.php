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
        Schema::create('dropdown_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('active_flag')->default(1);
            $table->integer('area_id')->unsigned()->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dropdowns', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->default(0);
            $table->string('name');
            $table->tinyInteger('active_flag')->default(1);
            $table->integer('area_id')->unsigned()->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dropdown_categories');
        Schema::dropIfExists('dropdowns');
    }
};
