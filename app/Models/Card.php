<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $fillable=['offre_id','user_id'];



    public function offre()
    {
        return $this->belongsTo(Offre::class, 'offre_id');
    }
}


