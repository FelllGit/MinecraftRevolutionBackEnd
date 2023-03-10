<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = "posts";

    protected $fillable = [
        'id',
        'name',
        'description',
        'body',
        'created_at',
        'updated_at',
    ];
}
