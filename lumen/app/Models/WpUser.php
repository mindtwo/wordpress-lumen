<?php
namespace App\Models;

class WpUser extends WpModel
{
    protected $primaryKey = 'ID';
    protected $timestamp = false;
    public function meta()
    {
        return $this->hasMany('App\Models\WpUserMeta', 'user_id');
    }
}