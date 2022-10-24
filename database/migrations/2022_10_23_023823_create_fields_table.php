<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fields', function (Blueprint $table) {

            // Columns
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('type', 20)->nullable();
            $table->string('applies_to', 255)->nullable();
            $table->boolean('required');
            $table->unsignedSmallInteger('order')->nullable();
            $table->foreignId('created_by_id')->nullable();
            $table->foreignId('updated_by_id')->nullable();
            $table->foreignId('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('created_by_id', 'IX_fields_created_by_id');
            $table->index('updated_by_id', 'IX_fields_updated_by_id');
            $table->index('deleted_by_id', 'IX_fields_deleted_by_id');

            // Foreign Keys
            $table->foreign('created_by_id', 'FK_fields_users_created_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by_id', 'FK_fields_users_updated_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('deleted_by_id', 'FK_fields_users_deleted_by_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fields');
    }
};
