<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $fillable = [
        "id", "lophoc_id", "content",'date','maxscore','user_id'
    ];
    
    protected $table = 'homework';
    protected $primaryKey = 'id';
}
