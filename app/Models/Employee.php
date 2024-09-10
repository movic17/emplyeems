<?php

namespace App\Models;

use App\Models\Attendance;
use App\Models\Expense;
use App\Models\Holiday;
use App\Models\Leave;
use App\Models\Salary;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'department_id',
        'designation_id',
        'first_name',
        'last_name',
        'dob',
        'gender',
        'join_date',
    ];

    protected $casts = ['dob' => 'date'];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function holidays(): HasMany
    {
        return $this->hasMany(Holiday::class);
    }

    public function leaves(): HasMany
    {
        return $this->hasMany(Leave::class);
    }

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }
}
