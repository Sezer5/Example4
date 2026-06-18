<?php

use App\Models\Keyword;
use App\Models\Poem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('keyword_poem', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Keyword::class, 'keyword_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Poem::class, 'poem_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keyword_poem');
    }
};
