<?php

declare(strict_types=1);

namespace Praetorian\Slugger;

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
        $text = $this->replaceNonLetterOrDigitsByDivider(text: $text, divider: $divider);

        $text = $this->transliterate(text: $text);

        $text = $this->removeUnwantedCharacters(text: $text);

        $text = $this->trimText(text: $text, divider: $divider);

        $text = $this->removeDuplicateDivider(text: $text, divider: $divider);

        $text = $this->lowerCaseText(text: $text);

        if (empty($text)) {
            throw new CannotSlugifyException(message: 'An empty string cannot be converted to a slug.');
        }

        return $text;
    }

    /**
     * @param  string  $text
     * @param  string  $divider
     * @return array|string|string[]|null
     */
    private function replaceNonLetterOrDigitsByDivider(string $text, string $divider): array|string|null
    {
        return preg_replace(pattern: '~[^\pL\d]+~u', replacement: $divider, subject: $text);
    }

    /**
     * @param  array|string|null  $text
     * @return bool|string
     */
    private function transliterate(array|string|null $text): bool|string
    {
        return iconv(from_encoding: 'utf-8', to_encoding: 'us-ascii//TRANSLIT', string: $text);
    }

    /**
     * @param  bool|string  $text
     * @return array|string|null
     */
    private function removeUnwantedCharacters(bool|string $text): array|string|null
    {
        return preg_replace(pattern: '~[^-\w]+~', replacement: '', subject: $text);
    }

    /**
     * @param  string  $text
     * @param  string  $divider
     * @return string
     */
    private function trimText(string $text, string $divider): string
    {
        return trim(string: $text, characters: $divider);
    }

    /**
     * @param  string  $text
     * @param  string  $divider
     * @return array|string|string[]|null
     */
    private function removeDuplicateDivider(string $text, string $divider): array|string|null
    {
        return preg_replace(pattern: '~-+~', replacement: $divider, subject: $text);
    }

    /**
     * @param  string  $text
     * @return array|false|string|string[]|null
     */
    private function lowerCaseText(string $text): array|bool|string|null
    {
        return mb_strtolower(string: $text);
    }
}
