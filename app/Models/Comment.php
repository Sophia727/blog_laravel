<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        "message",
        "name",
        "email",
        "article"
    ];
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
