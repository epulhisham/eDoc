<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Folder extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['name, file_id, user_id'];

    public function files ()
    {
        return $this->hasMany(File::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
