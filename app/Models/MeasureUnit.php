<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeasureUnit extends Model
{
    use HasFactory;

    protected $fillable = ['name','isoName'];

    public function chemicals() : HasMany
    {
        return $this->hasMany(Chemical::class, 'measure_unit_id');
    }
}
