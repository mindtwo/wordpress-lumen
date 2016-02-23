<?php

namespace App\Models;

class WpUserMeta extends WpModel
{
    protected $primaryKey = 'meta_id';
    protected $table = 'usermeta';
    public $timestamps = false;
}