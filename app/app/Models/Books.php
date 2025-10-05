<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'publisher',
        'edition',
        'publication_year',
        'price',
    ];

    public function Authors()
    {
        return $this->belongsToMany(Authors::class);
    }

    public function Subjects()
    {
        return $this->belongsToMany(Subjects::class);
    }
}
