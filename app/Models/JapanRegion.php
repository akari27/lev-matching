<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JapanRegion extends Model
{
    use HasFactory;
    
    public function hobbycategory()
    {
        return $this->belongsTo(HobbyCategory::class);
    }
    public function japanlocations()
    {
        return $this->hasMany(JapaneseLocation::class);
    }
}
