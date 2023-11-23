<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoDivision extends Model
{
    use HasFactory;
    public function countries()
    {
        return $this->hasMany(Country::class);
    }
}
