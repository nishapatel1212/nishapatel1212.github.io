<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer',
        'contact',
        'property_address',
        'job_number',
        'previous_inspection',
        'inspection_date',
        'next_inspection_due'
    ];

    public function regulations()
    {
        return $this->hasMany(Regulation::class, 'safety_inspection_id');
    }
}
