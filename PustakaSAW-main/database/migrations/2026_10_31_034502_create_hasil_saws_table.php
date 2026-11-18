
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hasil_saws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggotas')->cascadeOnDelete();
            $table->decimal('nilai_akhir', 12, 6)->default(0);
            $table->unsignedInteger('peringkat')->nullable();
            $table->timestamps();

            $table->unique('anggota_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_saws');
    }
};
