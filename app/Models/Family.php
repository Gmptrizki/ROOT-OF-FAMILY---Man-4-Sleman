<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'birth_date',
        'photo',
        'parent_id',
        'spouse_id',
        'relationship_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relationship()
    {
        return $this->belongsTo(Relationship::class);
    }

    public function parent()
    {
        return $this->belongsTo(Family::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Family::class, 'parent_id');
    }

    public function spouse()
    {
        return $this->belongsTo(Family::class, 'spouse_id');
    }

    public function siblings()
    {
        return $this->parent
            ? $this->parent->children()->where('id', '!=', $this->id)
            : collect();
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
}
