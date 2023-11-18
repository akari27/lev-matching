<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public function japanese()
    {
        return $this->hasOne(Japanese::class);
    }
    public function foreignvisitor()
    {
        return $this->hasOne(ForeignVisitor::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function chats()
    {
        return $this->hasMany(Chat::class);
    }
    public function hobbycategory()
    {
        return $this->belongsTo(HobbyCategory::class);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_japanese',
        'gender_flag',
        'age',
        'hobby_category_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
