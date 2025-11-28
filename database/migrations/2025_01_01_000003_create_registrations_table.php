<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('registration_number')->unique();
            $table->enum('status', ['draft', 'submitted', 'verified', 'rejected'])->default('draft');
            
            // Data Diri
            $table->string('full_name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('nik')->unique();
            $table->string('phone_number');
            $table->string('email');
            
            // Alamat
            $table->text('street_address');
            $table->string('village');
            $table->string('district');
            $table->string('regency');
            $table->string('province');
            $table->string('postal_code');
            
            // Pendidikan
            $table->string('education_level');
            $table->string('school_name');
            $table->string('major')->nullable();
            $table->year('graduation_year');
            
            // Fisik
            $table->decimal('height', 5, 2); // cm
            $table->decimal('weight', 5, 2); // kg
            
            // Kontak Darurat
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship');
            $table->string('emergency_contact_phone');
            
            // Verifikasi
            $table->string('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->text('verification_notes')->nullable();
            $table->text('rejection_reason')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
