<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('widgets_widgets', function (Blueprint $table) {
            $table->id();
            // Free string: the theme says which areas it has, a plugin may add its own.
            $table->string('area')->default('footer');
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['area', 'is_active', 'position']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('widgets_widgets');
    }
};
