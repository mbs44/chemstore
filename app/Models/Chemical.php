<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chemical extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'chemicals';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'id'; // Optional, only if your primary key is different

    // If you want to allow mass assignment, specify the fillable attributes
    protected $fillable = [
        'chemical_name_sk',
        'chemical_name_en',
        'chemical_formula',
        'quantity',
        'measure_unit_id',
        'description',
        // Add other fields as necessary
    ];

    // If you want to disable timestamps (created_at and updated_at)
    public $timestamps = true; // Set to false if you don't want timestamps
}
