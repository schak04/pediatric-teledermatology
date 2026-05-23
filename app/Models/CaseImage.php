<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CaseImage extends Model
{
    protected $table = 'case_images';

    protected $fillable = ['case_id', 'path', 'order'];

    public function case()
    {
        return $this->belongsTo(DermatologyCase::class, 'case_id');
    }
}
