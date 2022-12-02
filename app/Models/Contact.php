<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property string $firstname
 * @property int $job_id
 * @property string $phone
 * @property string $email
 * @property int $user_id
 * @property int $company_id
 * @property Company $company
 * @property User $student
 * @property Job $job
 */
class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'firstname',
        'job_id',
        'phone',
        'email',
        'user_id',
        'company_id',
    ];

    ////////////////
    /// RELATIONSHIPS
    ///////////////

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }

    ////////////////
    /// CUSTOM
    ///////////////

    public function fullname(): string
    {
        return $this->firstname.' '.$this->name;
    }

    public function scopeSearch(Builder $query, string $search = null): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->where('firstname', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%');
    }
}
