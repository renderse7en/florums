<?php

use App\Models\Forum;
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
        Schema::create('threads', function (Blueprint $table) {

            // Columns
            $table->id();
            $table->foreignIdFor(Forum::class);
            $table->string('title', 255)->nullable();
            $table->unsignedBigInteger('count_posts')->nullable();
            $table->unsignedBigInteger('count_views')->nullable();
            $table->dateTime('locked')->nullable();
            $table->text('locked_message')->nullable();
            $table->dateTime('hidden')->nullable();
            $table->foreignId('locked_by_id')->nullable();
            $table->foreignId('hidden_by_id')->nullable();
            $table->foreignId('created_by_id')->nullable();
            $table->foreignId('updated_by_id')->nullable();
            $table->foreignId('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('forum_id', 'IX_threads_forum_id');
            $table->index('locked_by_id', 'IX_threads_locked_by_id');
            $table->index('hidden_by_id', 'IX_threads_hidden_by_id');
            $table->index('created_by_id', 'IX_threads_created_by_id');
            $table->index('updated_by_id', 'IX_threads_updated_by_id');
            $table->index('deleted_by_id', 'IX_threads_deleted_by_id');

            // Foreign Keys
            $table->foreign('forum_id', 'FK_threads_forums_forum_id')->cascadeOnDelete();
            $table->foreign('locked_by_id', 'FK_threads_users_locked_by_id')->nullOnDelete();
            $table->foreign('hidden_by_id', 'FK_threads_users_hidden_by_id')->nullOnDelete();
            $table->foreign('created_by_id', 'FK_threads_users_created_by_id')->nullOnDelete();
            $table->foreign('updated_by_id', 'FK_threads_users_updated_by_id')->nullOnDelete();
            $table->foreign('deleted_by_id', 'FK_threads_users_deleted_by_id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('threads');
    }
};
