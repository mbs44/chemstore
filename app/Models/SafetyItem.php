<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SafetyItem extends Model
{
    use HasFactory;

    protected $fillable = ['name_sk','name_en'];

}
