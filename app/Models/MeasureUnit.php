<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasureUnit extends Model
{
    use HasFactory;

    protected $fillable = ['name','isoName'];

    public function chemicals()
    {
        return $this->hasMany(Chemical::class, 'measure_unit_id');
    }
}
