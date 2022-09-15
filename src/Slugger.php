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
        $text = preg_replace(pattern: '~[^\pL\d]+~u', replacement: $divider, subject: $text);

        // transliterate
        $text = iconv(from_encoding: 'utf-8', to_encoding: 'us-ascii//TRANSLIT', string: $text);

        // remove unwanted characters
        $text = preg_replace(pattern: '~[^-\w]+~', replacement: '', subject: $text);

        // trim
        $text = trim(string: $text, characters: $divider);

        // remove duplicate divider
        $text = preg_replace(pattern: '~-+~', replacement: $divider, subject: $text);

        // lowercase
        $text = mb_strtolower(string: $text);

        if (empty($text)) {
            throw new CannotSlugifyException(message: 'An empty string cannot be converted to a slug.');
        }

        return $text;
    }
}
