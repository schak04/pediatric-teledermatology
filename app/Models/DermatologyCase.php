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
        'image_path',
        'description',
        'diagnosis',
        'treatment',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
