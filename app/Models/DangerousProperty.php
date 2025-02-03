<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DangerousProperty extends Model
{
    use HasFactory;

    protected $fillable = ['name_sk','name_en', 'description_sk', 'description_en'];

    public function chemicals() : BelongsToMany
    {
        return $this->belongsToMany(Chemical::class, 'chemical_dangerous_property');
    }
}
