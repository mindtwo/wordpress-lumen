<?php

namespace App\Models;

class WpTermTaxonomy extends WpModel {
    protected $primaryKey = 'term_taxonomy_id';
    protected $table = 'term_taxonomy';
    public $timestamps = false;
    protected $fillable = [];
}