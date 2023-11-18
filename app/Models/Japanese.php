<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Japanese extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function japanlocation()
    {
        return $this->belongsTo(japanlocation::class);
    }
    
    protected $fillable = [
        'user_id',
        'register_location_id',
        'often_go_location_id',
    ];
}

