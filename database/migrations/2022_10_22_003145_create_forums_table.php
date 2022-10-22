<?php

use App\Models\User;
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
        Schema::create('forums', function (Blueprint $table) {

            // Columns
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->text('rules')->nullable();
            $table->string('category', 255)->nullable();
            $table->unsignedBigInteger('count_threads')->nullable();
            $table->unsignedBigInteger('count_posts')->nullable();
            $table->boolean('private')->nullable();
            $table->dateTime('locked')->nullable();
            $table->foreignId('locked_by_id')->nullable();
            $table->foreignId('created_by_id')->nullable();
            $table->foreignId('updated_by_id')->nullable();
            $table->foreignId('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('locked_by_id', 'IX_forums_locked_by_id');
            $table->index('created_by_id', 'IX_forums_created_by_id');
            $table->index('updated_by_id', 'IX_forums_updated_by_id');
            $table->index('deleted_by_id', 'IX_forums_deleted_by_id');

            // Foreign Keys
            $table->foreign('locked_by_id', 'FK_forums_users_locked_by_id')->nullOnDelete();
            $table->foreign('created_by_id', 'FK_forums_users_created_by_id')->nullOnDelete();
            $table->foreign('updated_by_id', 'FK_forums_users_updated_by_id')->nullOnDelete();
            $table->foreign('deleted_by_id', 'FK_forums_users_deleted_by_id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forums');
    }
};
