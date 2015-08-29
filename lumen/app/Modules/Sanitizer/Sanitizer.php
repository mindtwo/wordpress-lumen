<?php 

namespace App\Module\Sanitizer;

/**
 * Class Sanitizer
 * @package App\Sanitizer
 */
abstract class Sanitizer {

    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param array $data
     * @param array $rules
     * @return array
     */
    public function sanitize(array $data, array $rules = null)
    {
        $data = $this->preformRecrusiveSanitizing($data);

        $rules = $rules ?: $this->getRules();

        foreach ($rules as $field => $sanitizers)
        {

            // Top level sanitizing
            if ( ! isset($data[$field])) continue;
            $data[$field] = $this->applySanitizersTo($data[$field], $sanitizers);
        }

        return $data;
    }

    /**
     * @param array $value
     * @param $sanitizers
     * @return string
     */
    private function applySanitizersTo($value, $sanitizers)
    {
        foreach ($this->splitSanitizers($sanitizers) as $sanitizer)
        {
            $method = 'sanitize'.ucwords($sanitizer);

            // If a custom sanitizer is registered on the subclass,
            // then let's trigger that instead.
            $value = method_exists($this, $method)
                ? call_user_func([$this, $method], $value)
                : call_user_func($sanitizer, $value);
        }

        return $value;
    }

    /**
     * @param $sanitizers
     * @return array
     */
    private function splitSanitizers($sanitizers)
    {
        return is_array($sanitizers) ? $sanitizers : explode('|', $sanitizers);
    }

    /**
     * @param $a
     * @return bool
     */
    private function isMultidimensionalArray($a) {
        $rv = array_filter($a,'is_array');
        if(count($rv)>0) return true;
        return false;
    }

    /**
     * @param array $data
     * @return array
     */
    private function preformRecrusiveSanitizing(array $data)
    {
        if ($this->isMultidimensionalArray($data))
        {
            foreach ($data as $key => $value)
            {
                if (is_array($value))
                {
                    $data[$key] = $this->sanitize($value);
                }
            }
        };

        return $data;
    }

    /**
     * Sanitize
     *
     * @param $s
     * @return string
     */
    private function sanitizeMutated($s,$inverse=false)
    {
        $upas = Array(
            "ä" => "ae",
            "ü" => "ue",
            "ö" => "oe",
            "Ä" => "Ae",
            "Ü" => "Ue",
            "Ö" => "Oe"
        );

        // Inverse
        if($inverse){
            $upas = array_flip($upas);
        }

        return strtr($s, $upas);
    }

    /**
     * Sanitize inverse
     *
     * @param $s
     * @return string
     */
    private function sanitizeMutatedInverse($s)
    {
        return $this->sanitizeMutated($s,true);
    }

}