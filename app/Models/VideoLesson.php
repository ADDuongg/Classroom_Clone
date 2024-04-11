<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoLesson extends Model
{
    use HasFactory;
    protected $fillable = [
        "videolesson_id","file_subject","monhoc_id","file_path"
    ];
    protected $keyType = 'string';
    protected $table = 'videolesson';
    protected $primaryKey = 'videolesson_id';
}
