<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Show;

class Show extends Model
{
    use HasFactory;

    /*public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }*/

    protected $fillable = [
        'name',
        'category',
        //'description',
        //'rating',
    ];
    //protected $guarded = [];
}
