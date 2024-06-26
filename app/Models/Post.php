<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        "id", "lophoc_id", "user_id", "content"
    ];
    protected $table = "posts";
    protected $primaryKey = "id";
    /* protected $keyType = 'string'; */

}
