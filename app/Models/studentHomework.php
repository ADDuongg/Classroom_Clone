<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentHomework extends Model
{
    use HasFactory;
    protected $fillable = [
        "id", "user_id", "post_id","content",'isSubmit','score'
    ];
    protected $table = "studenthomework";
    protected $primaryKey = "id";
}
