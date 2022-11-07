<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property string $phone
 * @property string $address
 * @property string $city
 * @property string $zip
 * @property string $desire
 * @property bool $mobility
 * @property string $motivation
 * @property int $promotion_id
 * @property User $user
 * @property Promotion $promotion
 * @property Company $companies
 * @property Contact $contacts
 * @property Procedure $procedures
 */
class Student extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'phone',
        'address',
        'city',
        'zip',
        'desire',
        'mobility',
        'motivation',
        'promotion_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'promotion_id' => 'integer',
        'mobility' => 'boolean',
    ];

    ////////////////
    /// RELATIONSHIPS
    ///////////////

    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
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

    ////////////////
    /// CUSTOM
    ///////////////

    public function fullname(): string
    {
        return $this->user->firstname . ' ' . $this->user->lastname;
    }
}
