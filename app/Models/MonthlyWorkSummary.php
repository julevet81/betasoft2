<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyWorkSummary extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['employee_id', 'month', 'total_hours', 'notes'];

    
    protected $casts = [
        'month' => 'date',
        'total_hours' => 'integer',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
