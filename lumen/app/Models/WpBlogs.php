<?php

namespace App\Models;

class WpBlogs extends WpModel {
    protected $primaryKey = 'blog_id';
    protected $table = 'blogs';
    protected $fillable = [];
    const CREATED_AT = 'registered';
    const UPDATED_AT = 'last_updated';

    /**
     * Get current selected blog
     * @param $query
     *
     * @return mixed
     */
    function scopeCurrent($query) {
        return $query->where('domain','=',$_SERVER['HTTP_HOST']);
    }
}