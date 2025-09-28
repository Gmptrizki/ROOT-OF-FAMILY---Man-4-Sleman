<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('families', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->nullable();


            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('families')
                ->nullOnDelete();

            $table->foreignId('relationship_id')
                ->nullable()
                ->constrained('relationships')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
