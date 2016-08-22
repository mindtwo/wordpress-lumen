<?php

namespace WpTheme\Modules\Addon;

use Illuminate\Cache\CacheManager;

/**
 * @property \Laravel\Lumen\Application|mixed cache
 */
class WordPressTotalCache {
    protected $cache;

    /**
     * Initialize
     *
     * @param CacheManager $cache
     */
    public function __construct(CacheManager $cache) {
        $this->cache = $cache;

        /**
         * Add Redirects
         */
        if( function_exists( 'add_action' ) ) {
            add_action( 'w3tc_flush_all', [$this, 'clear_cache'] );
        }
    }

    public function clear_cache() {
        $this->cache->flush();
    }
}