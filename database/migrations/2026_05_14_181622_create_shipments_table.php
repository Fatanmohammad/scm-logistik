<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('status', ['pending', 'on_delivery', 'delivered']);
            $table->text('destination');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('shipments'); }
};