<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up(): void
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('target')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('model');
            $table->string('event');
            $table->json('before')->nullable();
            $table->json('after')->nullable();
            $table->string('observations')->nullable();
            $table->timestamp('createdAt');
            $table->timestamp('updatedAt');
            $table->timestamp('deletedAt')->nullable();

            $table->index(['id', 'target', 'event']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
