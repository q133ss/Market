<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function img()
    {
        return $this->morphOne(File::class, 'fileable', 'fileable_type', 'fileable_id', 'id')->where('category','banner');
    }
}
