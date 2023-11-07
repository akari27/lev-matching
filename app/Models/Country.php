<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    
    public function foreignvisitors()
    {
        return $this->hasMany(ForeignVisitor::class);
    }
    public function geodivision()
    {
        return $this->belongsTo(GeoDivision::class);
    }
}
