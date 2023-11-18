<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JapanLocation extends Model
{
    use HasFactory;
    
    public function japanese()
    {
        return $this->hasMany(Japanese::class);
    }
    
    public function foreignvisitors()
    {
        return $this->hasMany(ForeignVisitor::class);
    }
    
    public function japaneseregion()
    {
        return $this->belongsTo(JapanRegion::class);
    }
    
    protected $fillable = [
        'name',
    ];
}
