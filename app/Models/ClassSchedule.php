<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;
    protected $fillable = [
        "lichhoc_id", "lophoc_id", "monhoc_id", "day","start","end","hocky_id"
    ];
    protected $keyType = 'string';
    protected $table = 'lichhoc';
    protected $primaryKey = 'lichhoc_id';
}
