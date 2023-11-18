<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'fileable')->where('category', 'review');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'reviewable_id');
    }
}
