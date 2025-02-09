<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Experiment extends Model
{
    use HasFactory;

    protected $fillable = ['name_en', 'name_sk', 'description_en', 'description_sk'];

    public function chemicals(): BelongsToMany
    {
        return $this->belongsToMany(Chemical::class, 'chemical_experiment');
    }
}
