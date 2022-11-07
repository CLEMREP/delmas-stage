<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'student_id',
        'contact_id',
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
        return $this->belongsTo(Student::class);
    }

    public function procedure(): HasOne
    {
        return $this->hasOne(Procedure::class);
    }

    ////////////////
    /// CUSTOM
    ///////////////

    public function completeAddress(): string
    {
        return $this->address . ', ' . $this->zip . ', ' . $this->city;
    }
}
