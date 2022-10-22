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
            $table->foreignIdFor(User::class, 'locked_by_id')->nullable();
            $table->foreignIdFor(User::class, 'hidden_by_id')->nullable();
            $table->foreignIdFor(User::class, 'created_by_id')->nullable();
            $table->foreignIdFor(User::class, 'updated_by_id')->nullable();
            $table->foreignIdFor(User::class, 'deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('locked_by_id', 'IX_threads_locked_by_id');
            $table->index('hidden_by_id', 'IX_threads_hidden_by_id');
            $table->index('created_by_id', 'IX_threads_created_by_id');
            $table->index('updated_by_id', 'IX_threads_updated_by_id');
            $table->index('deleted_by_id', 'IX_threads_deleted_by_id');

            // Foreign Keys
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
