<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'birth_date',
    ];

    protected static function booted()
    {
        static::created(function ($user) {
            $family = Family::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'birth_date' => $user->birth_date,
                'relationship_id' => null,
                'parent_id' => null,      
                'spouse_id' => null,
            ]);

            $family->parent_id = $family->id;
            $family->save();
        });
}

    public function family()
    {
        return $this->hasOne(Family::class);
    }
}
