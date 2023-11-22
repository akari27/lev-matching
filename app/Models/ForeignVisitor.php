<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignVisitor extends Model
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
    
    protected $fillable =[
        "user_id",
        "register_location_id",
        "stay_location_id",
        "start_of_stay",
        "end_of_stay",
        "reason",
        ];
}
