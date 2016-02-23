<?php
namespace App\Models;

class WpPostMeta extends WpModel
{
    protected $primaryKey = 'meta_id';
    protected $table = 'postmeta';
    protected $fillable = ['post_id', 'meta_key', 'meta_value'];
    public $timestamps = false;
}

