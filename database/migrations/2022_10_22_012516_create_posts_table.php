<?php

use App\Models\Forum;
use App\Models\Thread;
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
        Schema::create('posts', function (Blueprint $table) {

            // Columns
            $table->id();
            $table->foreignIdFor(Forum::class);
            $table->foreignIdFor(Thread::class);
            $table->text('content')->nullable();
            $table->unsignedBigInteger('count_views')->nullable();
            $table->string('ip_address', 39)->nullable();
            $table->dateTime('hidden')->nullable();
            $table->foreignId('hidden_by_id')->nullable();
            $table->foreignId('created_by_id')->nullable();
            $table->foreignId('updated_by_id')->nullable();
            $table->foreignId('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('forum_id', 'IX_posts_forum_id');
            $table->index('thread_id', 'IX_posts_thread_id');
            $table->index('hidden_by_id', 'IX_posts_hidden_by_id');
            $table->index('created_by_id', 'IX_posts_created_by_id');
            $table->index('updated_by_id', 'IX_posts_updated_by_id');
            $table->index('deleted_by_id', 'IX_posts_deleted_by_id');

            // Foreign Keys
            $table->foreign('forum_id', 'FK_posts_forums_forum_id')->references('id')->on('forums')->cascadeOnDelete();
            $table->foreign('thread_id', 'FK_posts_threads_thread_id')->references('id')->on('threads')->cascadeOnDelete();
            $table->foreign('hidden_by_id', 'FK_posts_users_hidden_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by_id', 'FK_posts_users_created_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by_id', 'FK_posts_users_updated_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('deleted_by_id', 'FK_posts_users_deleted_by_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
