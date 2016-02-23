<?php

namespace App\Models;

class WpTerm extends WpModel {
    protected $primaryKey = 'term_id';
    protected $table = 'terms';
    public $timestamps = false;
    protected $fillable = [];

    /**
     * Get term taxonomy
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function taxonomy(){
        return $this->belongsTo('App\Models\WpTermTaxonomy', 'term_id', 'term_taxonomy_id');
    }
}