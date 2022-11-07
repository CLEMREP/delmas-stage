<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    ];

    ////////////////
    /// RELATIONSHIPS
    ///////////////

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
        return $this->firstname . ' ' . $this->name;
    }
}
