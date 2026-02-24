<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'safety_inspection_id',
        'regulation',
        'location',
        'rectification',
        'image',
    ];

    public function safetyInspection()
    {
        return $this->belongsTo(SafetyCheck::class);
    }
}
