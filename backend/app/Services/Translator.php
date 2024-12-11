<?php

namespace App\Services;

use Illuminate\Support\Facades\Lang;

class Translator
{
    /**
     * Get the translation for the given key.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string
     */
    public function get($key, array $replace = [], $locale = null)
    {
        return Lang::get($key, $replace, $locale);
    }

    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string
     */
    public function translate($key, array $replace = [], $locale = null)
    {
        return $this->get($key, $replace, $locale);
    }
} 