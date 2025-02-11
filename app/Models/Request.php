<?php

// app/Models/Request.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'requests';

    // Define the fillable attributes
    protected $fillable = [
        'experiment_id',
        'status_id',
        'requested_by',
        'resolved_by',
        'experiment_date',
        'resolved_date',
        'note',
        'reject_reason',
    ];

    // Define relationships

    public function experiment():BelongsTo
    {
        return $this->belongsTo(Experiment::class);
    }

    public function status():BelongsTo
    {
        return $this->belongsTo(Status::class);
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
            ->withPivot('measure_unit_id', 'quantity')
            ->withTimestamps();
    }
}
