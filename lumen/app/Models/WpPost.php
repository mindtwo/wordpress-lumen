<?php

namespace App\Models;

class WpPost extends WpModel {
    protected $table = 'posts';
    protected $primaryKey = 'ID';
    protected $post_type = null;
    const CREATED_AT = 'post_date';
    const UPDATED_AT = 'post_modified';

    /**
     * @var array
     */
    protected $fillable = ['post_title', 'post_author', 'post_type', 'comment_status', 'ping_status'];

    /**
     * Filter by post type
     *
     * @param $query
     * @param string $type
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, $type='post')
    {
        $this->post_type = $type;
        return $query->where('post_type', $type);
    }

    /**
     * Filter by post status
     *
     * @param $query
     * @param string $status
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status = 'publish')
    {
        return $query->where('post_status', '=', $status);
    }

    /**
     * Filter by post author
     *
     * @param $query
     * @param null $author
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAuthor($query, $author = null)
    {
        if ($author) {
            return $query->where('post_author', '=', $author);
        }
    }

    /**
     * Get comments from the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\Models\WpComment', 'comment_post_ID');
    }

    /**
     * Get meta fields from the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta()
    {
        return $this->hasMany('App\Models\WpPostMeta', 'post_id');
    }

    /**
     * Get term fields from the post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function term(){
        return $this->belongsToMany('App\Models\WpTerm', $this->get_table_name_with_blog_id('term_relationships'), 'object_id', 'term_taxonomy_id');
    }

}