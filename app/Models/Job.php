<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder as QueryBuilder;


class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    public static $experience = ['entry', 'intermediate', 'senior'];
    public static $category = ['IT', 'Finance', 'Healthcare', 'Education', 'Engineering','Marketing','Sale'];
    
    public function employer():BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filter): Builder|QueryBuilder
    {
        return $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%');
            });
        })->when($filter['min_salary'] ?? null, function ($query, $minSalary) {
            $query->where('salary', '>=', $minSalary);
        })->when($filter['max_salary'] ?? null, function ($query, $maxSalary) {
            $query->where('salary', '<=', $maxSalary);
        })->when($filter['experience_level'] ?? null, function ($query, $experienceLevel) {
            $query->where('experience_level', $experienceLevel);
        })->when($filter['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        });
    }
}
