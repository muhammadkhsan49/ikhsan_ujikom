<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'registration_number',
        'status',
        'full_name',
        'gender',
        'date_of_birth',
        'place_of_birth',
        'nik',
        'phone_number',
        'email',
        'street_address',
        'village',
        'district',
        'regency',
        'province',
        'postal_code',
        'education_level',
        'school_name',
        'major',
        'graduation_year',
        'height',
        'weight',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'verified_by',
        'verified_at',
        'verification_notes',
        'rejection_reason',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'height' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Generate registration number
     */
    public static function generateRegistrationNumber()
    {
        $year = date('Y');
        $count = Registration::whereYear('created_at', $year)->count() + 1;
        return 'BRIMOB-' . $year . '-' . str_pad($count, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Check if registration is verified
     */
    public function isVerified()
    {
        return $this->status === 'verified';
    }

    /**
     * Check if registration is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if registration is submitted
     */
    public function isSubmitted()
    {
        return $this->status === 'submitted';
    }
}
