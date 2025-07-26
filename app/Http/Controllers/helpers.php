<?php

if (!function_exists('renderCopticVerses')) {
    function renderCopticVerses($text) {
        // يقسم النص إلى أرباع بناءً على + ... .
        $pattern = '/\+\s*(.*?)\./us';
        preg_match_all($pattern, $text, $matches);
        $output = '';
        foreach ($matches[1] as $verse) {
            $output .= '<div style="margin-bottom: 12px;"><span style="font-size:1.3em; color:#b12c2c;">✚</span> ' . trim($verse) . ' <span style="font-size:1.2em;">.</span></div>';
        }
        return $output;
    }
}
