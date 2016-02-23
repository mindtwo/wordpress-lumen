<?php

namespace App\Models;

class WpComment extends WpModel
{
    protected $primaryKey = 'comment_ID';

    /**
     * Post relation for a comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne('App\Models\WpPost');
    }
}