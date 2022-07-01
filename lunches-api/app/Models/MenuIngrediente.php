<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuIngrediente extends Model
{
    use HasFactory;
    protected $fillable = ['menu_id', 'ingrediente_id'];
}
