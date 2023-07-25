<?php

namespace App\Models;

use App\Traits\Slugger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use Slugger;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class, 'category_id');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'category_id');
    }
}
