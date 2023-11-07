<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignVistor extends Model
{
    use HasFactory;
    
    public function japanlocation()
    {
        return $this->belongsTo(JapanLocation::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
