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

            // pemilik pohon
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable(); // path foto

            // relasi keluarga
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->unsignedBigInteger('spouse_id')->nullable();
            $table->foreignId('relationship_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();

            // foreign key self-referencing
            $table->foreign('parent_id')->references('id')->on('families')->onDelete('set null');
            $table->foreign('spouse_id')->references('id')->on('families')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
