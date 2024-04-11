<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $fillable = [
        "hocky_id", "hocky", "namhoc"
    ];
    protected $table = "hocky";
    protected $primaryKey = "hocky_id";
    protected $keyType = 'string';
}
