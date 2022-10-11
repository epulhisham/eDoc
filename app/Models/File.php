<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function folder ()
    {
        return $this->belongsTo(Folder::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }



}
