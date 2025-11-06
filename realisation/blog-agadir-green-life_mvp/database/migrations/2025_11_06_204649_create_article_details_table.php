<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('article_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade')->unique();
            // colonnes de détail
            $table->string('slug')->unique()->nullable();
            $table->string('summary', 512)->nullable();        // court résumé
            $table->text('content_full')->nullable();         // contenu long (si tu veux séparer)
            $table->string('hero_image')->nullable();         // chemin image principale
            $table->json('tags')->nullable();                 // tags json ['eco','tourisme']
            $table->enum('status', ['draft','published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('views')->default(0);
            $table->integer('reading_time')->nullable();      // en minutes
            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('article_details');
    }
};
