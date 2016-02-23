<?php

namespace App\Models;

use Cache;
use DB;
use Illuminate\Database\Eloquent\Model;

class WpModel extends Model {

    /**
     * @return mixed
     */
    public function getTable() {
        if ( isset( $this->table ) ) {
            $table = $this->table;
        } else {
            $table = str_replace( ['\\', 'Wp'], '', snake_case( str_plural( class_basename( $this ) ) ) );
        }

        return $this->get_table_name_with_blog_id($table);
    }

    /**
     * @return int
     */
    protected function get_current_blog_id() {
        $query = Cache::rememberForever('blogs_'.$_SERVER['HTTP_HOST'], function() {
            return DB::table('blogs')->where('domain','=',$_SERVER['HTTP_HOST'])->select('blog_id')->first();
        });

        return (!empty($query)) ? $query->blog_id : 1;
    }

    /**
     * @param $table
     *
     * @return mixed
     */
    protected function get_table_name_with_blog_id($table) {
        $prefix = DB::getTablePrefix();

        $global_tables = [
            $prefix . 'blogs',
            $prefix . 'users',
            $prefix . 'site',
            $prefix . 'sitemeta',
            $prefix . 'signups',
            $prefix . 'usermeta',
        ];

        $blog_id = $this->get_current_blog_id();

        if($blog_id != 1 && !in_array($table, $global_tables)) {
            $current_blog_prefix = $prefix . $blog_id . '_';
            return str_replace($prefix, $current_blog_prefix, $table);
        }

        return $table;
    }
}