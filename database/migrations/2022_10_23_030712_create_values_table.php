<?php

use App\Models\Field;
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
        Schema::create('values', function (Blueprint $table) {

            // Columns
            $table->id();
            $table->foreignIdFor(Field::class);
            $table->string('link_type');
            $table->foreignId('link_id');
            $table->text('value')->nullable();
            $table->foreignId('created_by_id')->nullable();
            $table->foreignId('updated_by_id')->nullable();
            $table->foreignId('deleted_by_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('field_id', 'IX_values_field_id');
            $table->index(['link_type', 'link_id'], 'IX_values_link_id_link_type');
            $table->index('created_by_id', 'IX_values_created_by_id');
            $table->index('updated_by_id', 'IX_values_updated_by_id');
            $table->index('deleted_by_id', 'IX_values_deleted_by_id');

            // Foreign Keys
            $table->foreign('field_id', 'FK_values_field_id')->references('id')->on('fields')->cascadeOnDelete();
            $table->foreign('created_by_id', 'FK_values_users_created_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('updated_by_id', 'FK_values_users_updated_by_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('deleted_by_id', 'FK_values_users_deleted_by_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
};
