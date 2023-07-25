<?php

namespace App\Models;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Slugger;

    protected $fillable = [
        'name',
        'slug',
    ];
}
