<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DermatologyCase extends Model
{
    use HasFactory;

    protected $table = 'cases';

    protected $fillable = [
        'user_id',
        'doctor_id',
        // legacy single image (kept for backwards compat)
        'image_path',
        // presenting complaint
        'child_name',
        'child_age',
        'child_age_unit',
        'sex',
        'title',
        'description',
        'body_location',
        'duration',
        'symptoms',
        'severity',
        'additional_notes',
        // medical history
        'medications',
        'allergies',
        'prior_conditions',
        'family_history',
        // doctor diagnosis (structured)
        'icd_code',
        'diagnosis_condition',
        'diagnosis',           // legacy plain-text diagnosis
        'diagnosis_summary',
        'treatment',           // legacy plain-text treatment
        'treatment_steps',
        'follow_up',
        'severity_doctor',
        // status / flow
        'status',
        'info_request',
        'info_reply',
    ];

    protected $casts = [
        'symptoms'        => 'array',
        'treatment_steps' => 'array',
        'child_age'       => 'integer',
        'severity'        => 'integer',
        'severity_doctor' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function images()
    {
        return $this->hasMany(CaseImage::class, 'case_id')->orderBy('order');
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'submitted'  => 'Submitted',
            'needs_info' => 'Needs more info',
            'in_review'  => 'In review',
            'diagnosed'  => 'Diagnosed',
            'closed'     => 'Closed',
            default      => ucfirst($this->status),
        };
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'submitted'  => 'badge--submitted',
            'needs_info' => 'badge--needs-info',
            'in_review'  => 'badge--review',
            'diagnosed'  => 'badge--diagnosed',
            'closed'     => 'badge--closed',
            default      => 'badge--submitted',
        };
    }

    public function isActive(): bool
    {
        return ! in_array($this->status, ['diagnosed', 'closed']);
    }
}
