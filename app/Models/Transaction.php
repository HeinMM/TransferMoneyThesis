<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public function nation()
    {
        return $this->belongsTo(Nation::class);
    }

    public function nationImage(){
        return $this->hasOneThrough(NationImage::class,Nation::class);
    }
}
