<?php

namespace App\Models;

use App\Models\Enums\Roles;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property Roles $role
 * @property string $address
 * @property string $city
 * @property string $zip
 * @property string $desire
 * @property string $motivation
 * @property int $promotion_id
 * @property Promotion $promotion
 * @property Collection $promotions
 * @property Company $companies
 * @property Contact $contacts
 * @property Procedure $procedures
 * @property Serie $series
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone',
        'role',
        'password',
        'address',
        'city',
        'zip',
        'desire',
        'mobility',
        'motivation',
        'promotion_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'role' => Roles::class,
        'email_verified_at' => 'datetime',
        'promotion_id' => 'integer',
        'mobility' => 'boolean',
    ];

    ////////////////
    /// RELATIONSHIPS
    ///////////////

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }

    public function series(): BelongsToMany
    {
        return $this->BelongsToMany(Serie::class);
    }

    ////////////////
    /// CUSTOM
    ///////////////

    public function is_super_admin(): bool
    {
        return $this->role == Roles::Admin;
    }

    public function is_admin(): bool
    {
        return $this->role == Roles::Admin;
    }

    public function is_teacher(): bool
    {
        return $this->role == Roles::Teacher;
    }

    public function is_student(): bool
    {
        return $this->role == Roles::Student;
    }

    public function fullname(): string
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function scopeSearch(Builder $query, string $search = null): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->where('firstname', 'like', '%'.$search.'%')
                ->orWhere('lastname', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
    }

    public function scopeStudent(Builder $query): Builder
    {
        return $query->where('role', Roles::Student);
    }

    public function scopeTeacher(Builder $query): Builder
    {
        return $query->where('role', Roles::Teacher);
    }

    public function scopeAdmin(Builder $query): Builder
    {
        return $query->where('role', Roles::Admin);
    }
}
