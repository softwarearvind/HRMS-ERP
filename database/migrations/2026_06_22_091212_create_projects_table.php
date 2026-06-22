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
        Schema::create('projects', function (Blueprint $table) {
           $table->id();
           $table->foreignId('client_id')->constrained()->onDelete('cascade');
           $table->string('project_name');
           $table->text('description')->nullable();
           $table->date('start_date');
           $table->date('end_date');
           $table->enum('status', [
                'new',
                'pending',
                'running',
                'completed',
                'rejected'
            ])->default('new');
            $table->foreignId('created_by')->nullable(); // manager/admin
            $table->foreignId('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
