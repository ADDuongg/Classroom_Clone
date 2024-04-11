<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        "id", "user_id", "post_id", "content"
    ];
    protected $table = 'comments';
    protected $primaryKey = 'id';
    protected function serializeDate(\DateTimeInterface $date)
    {
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
}
