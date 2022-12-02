<?php

namespace App\Models;

use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $format_id
 * @property int $status_id
 * @property Date $date
 * @property bool $resend
 * @property Date $date_resend
 * @property int $user_id
 * @property int $promotion_id
 * @property int $company_id
 * @property int $contact_id
 * @property Contact $contact
 * @property User $student
 * @property Company $company
 * @property Status $status
 * @property Format $format
 * @property Promotion $promotion
 */
class Procedure extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'format_id',
        'status_id',
        'date',
        'resend',
        'date_resend',
        'user_id',
        'promotion_id',
        'company_id',
        'contact_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'date',
        'resend_date' => 'date',
        'resend' => 'boolean',
    ];

    ////////////////
    /// RELATIONSHIPS
    ///////////////

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function format(): BelongsTo
    {
        return $this->belongsTo(Format::class);
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    ////////////////
    /// CUSTOM
    ///////////////

    public function scopeSearch(Builder $query, string $search = null): Builder
    {
        if (! $search) {
            return $query;
        }

        return $query->with('company')
            ->where('company.name', 'like', '%'.$search.'%');
    }
}
