<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'Proprietaire',
        'Location',
        'Descreption',
        'Category',
        'tel',
        'Price',
        'Type_Offre'
    ];
}
