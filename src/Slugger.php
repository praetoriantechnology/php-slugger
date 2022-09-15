<?php

declare(strict_types=1);

namespace Praetorian\PhpSlugger;

class Slugger
{
    /**
     * @param  string  $text
     * @param  string  $divider
     * @return string
     * @throws CannotSlugifyException
     */
    public function slugify(string $text, string $divider = '-'): string
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = mb_strtolower($text);

        if (empty($text)) {
            throw new CannotSlugifyException('An empty string cannot be converted to a slug.');
        }

        return $text;
    }
}
