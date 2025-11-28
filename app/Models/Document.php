<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'document_type',
        'file_path',
        'original_filename',
    ];

    /**
     * Relationships
     */
    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    /**
     * Get document type label
     */
    public function getDocumentTypeLabel()
    {
        return match($this->document_type) {
            'ktp' => 'KTP',
            'ijazah' => 'Ijazah',
            'foto_formal' => 'Foto Formal',
            'surat_kesehatan' => 'Surat Kesehatan',
            default => 'Dokumen',
        };
    }
}
