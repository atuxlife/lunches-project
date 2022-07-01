<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredienttList extends Model
{
    use HasFactory;
    protected $fillable = ['ingrediente_id', 'qty', 'requested'];
}
