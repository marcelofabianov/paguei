<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('userId')->index();
            $table->string('name');
            $table->boolean('public')->default(false);
            $table->datetime('inactivatedAt')->nullable();
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            $table->timestamp('deletedAt')->nullable();

            $table->index(['id', 'inactivatedAt', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
