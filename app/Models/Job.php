<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder as QueryBuilder;


class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory,SoftDeletes;

    protected $fillable = ['title','location','salary','description','experience_level','category'];

    public static $experience = ['entry', 'intermediate', 'senior'];
    public static $category = ['IT', 'Finance', 'Healthcare', 'Education', 'Engineering','Marketing','Sale'];
    
    public function employer():BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }
    public function jobApplications():HasMany{
        return $this->hasMany(JobApplication::class);
    }

    public function hasUserApplied(Authenticate|User|int $user) :bool {
        return $this->where('id',$this->id)
            ->whereHas(
                'jobApplications',
                fn($query)=>$query->where('user_id','=',$user->id ?? $user )
            )->exists();
    }

    public function scopeFilter(Builder|QueryBuilder $query, array $filter): Builder|QueryBuilder
    {
        return $query->when($filter['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhereHas('employer',function($query)use($search){
                    $query->where('company_name','like','%'. $search .'%');
                });
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
