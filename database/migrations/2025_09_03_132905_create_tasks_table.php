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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->enum('status', ['Pending','In-Progress', 'Completed'])->default('Pending');
            $table->enum('priority', ['High','Medium', 'Low'])->default('Low');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('area_id');
            $table->tinyInteger('active_flag')->default(1);
            $table->integer('assigned_task_id')->constrained('task', 'task_id')->default(1);
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->enum('status', ['Pending','In-Progress', 'Completed'])->default('Pending');
            $table->enum('priority', ['High','Medium', 'Low'])->default('Low');
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->integer('task_id');
            $table->integer('assigned_staff_id')->constrained('staff', 'staff_id');
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');

        Schema::dropIfExists('sub_tasks');
    }
};
