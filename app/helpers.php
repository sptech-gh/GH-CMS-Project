<?php

use App\Models\Church;

if (!function_exists('currentChurch')) {
    /**
     * Get the currently selected church.
     *
     * @return Church|null
     */
    function currentChurch(): ?Church
    {
        static $cachedChurch = null;

        if ($cachedChurch !== null) {
            return $cachedChurch;
        }

        $cachedChurch = app()->bound('currentChurch')
            ? app('currentChurch')
            : null;

        return $cachedChurch;
    }
}

if (!function_exists('currentChurchName')) {
    /**
     * Get the name of the currently selected church.
     *
     * @param string $fallback
     * @return string
     */
    function currentChurchName(string $fallback = 'No Church Selected'): string
    {
        return currentChurch()?->name ?? $fallback;
    }
}
