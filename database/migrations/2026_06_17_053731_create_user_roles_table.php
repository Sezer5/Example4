<?php

use App\Models\Role;
use App\Models\User;
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
        // Standartlara uygun olarak 'role_user' yapıldı
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();

            // foreignIdFor kullanımı doğru, constrained() otomatik olarak 'users' tablosunu bulur
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Role::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // up() metodundaki isimle birebir aynı yapıldı
        Schema::dropIfExists('role_user');
    }
};
