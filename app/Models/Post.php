<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    /**
     * The appends.
     *
     * @var array<int, string>
     */
    protected $appends = ['created_at_diff'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'post',
      'user_id',
    ];

    public function getCreatedAtDiffAttribute()
    {
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']))->diffForHumans();
    }


    /**
     * Get the user for the post.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
