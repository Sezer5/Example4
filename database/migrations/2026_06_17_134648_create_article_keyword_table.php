<?php

use App\Models\Article;
use App\Models\Keyword;
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
        Schema::create('article_keyword', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Article::class, 'article_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Keyword::class, 'keyword_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_keyword');
    }
};
