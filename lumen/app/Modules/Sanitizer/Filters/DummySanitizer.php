<?php 

namespace App\Module\Sanitizer\Filters;

use App\Module\Sanitizer\Sanitizer;

/**
 * Class SanitizeDummy
 * @package App\Sanitizer
 */
class DummySanitizer extends Sanitizer {

    /**
     * Rules
     *
     * @var array
     */
    protected $rules = [
        'dummy_key' => 'boolean'
    ];

    /**
     * Sanitize boolean to Yes or No
     *
     * @param $s
     * @return string
     */
    function sanitizeBoolean($s)
    {
        if($s == 'true') {
            $s = 'Ja';
        } elseif($s == 'false') {
            return 'Nein';
        }
        return $s;
    }
}