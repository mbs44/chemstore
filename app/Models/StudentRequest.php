<?php

// app/Models/StudentRequest.php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentRequest extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'student_requests';

    // Define the fillable attributes
    protected $fillable = [
        'experiment_id',
        'state_id',
        'requested_by',
        'resolved_by',
        'experiment_date',
        'resolved_date',
        'note',
        'teacher_note',
    ];

    // Define relationships

    public function experiment():BelongsTo
    {
        return $this->belongsTo(Experiment::class);
    }

    public function state():BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function requestedBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function resolvedBy():BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function chemicals()
    {
        return $this->belongsToMany(Chemical::class, 'request_chemical')
            ->withPivot('chemical_id', 'quantity')
            ->withTimestamps();
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function localDate(?string $isoDate):string
    {
        if ($isoDate) {

            $dateTime = new DateTime($isoDate);
            return $dateTime->format('d.m.Y');
        } else {
            return '';
        }
    }
}
