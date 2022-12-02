<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $zip
 * @property string $phone
 * @property int $user_id
 * @property int $promotion_id
 * @property Contact $contact
 * @property Student $student
 */
class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'zip',
        'user_id',
        'promotion_id',
    ];

    ////////////////
    /// RELATIONSHIPS
    ///////////////

    public function contacts(): HasMany
    {
        return $this->HasMany(Contact::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedure::class);
    }

    ////////////////
    /// CUSTOM
    ///////////////

    public function completeAddress(): string
    {
        return $this->address.', '.$this->zip.', '.$this->city;
    }

    public function scopeSearch(Builder $query, string $search = null): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->where('name', 'like', '%'.$search.'%')
            ->orWhere('phone', 'like', '%'.$search.'%')
            ->orWhere('address', 'like', '%'.$search.'%')
            ->orWhere('city', 'like', '%'.$search.'%')
            ->orWhere('zip', 'like', '%'.$search.'%');
    }
}
