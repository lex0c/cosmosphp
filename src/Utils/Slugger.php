<?php
namespace Cosmos\Utils;

/**
 * Slugger
 * @link https://github.com/lleocastro/cosmosphp/
 * @license https://github.com/lleocastro/cosmosphp/blob/master/LICENSE
 * @author Léo Castro <leonardo_carvalho@outlook.com>
 * @package Cosmos\Utils
 */
final class Slugger
{
    /**
     * Convert a string to slug.
     *
     * @param string $phrase
     * @param bool   $inArray
     * @param string $separator
     *
     * @return string/array
     *
     * @throws \InvalidArgumentException
     */
    public static function format(string $phrase, bool $inArray = false, string $separator = '-')
    {
        if ((empty($phrase)) || (empty($separator))) {
            throw new \InvalidArgumentException('Arguments not valid!');
        }

        // Characters not permitted.
        $scapeChars = ['!', '#', '%', '¨', '&', '*', '(', ')', '-', '_', '=', '+', '\\', '|', ',',
            ';', '<', '>', '[', ']', '~', '´', '/', '?', '{', '}'];

        // Scape characters not permitted.
        for ($i = 0; $i < count($scapeChars); $i++) {
            $phrase = str_ireplace($scapeChars[$i], '', $phrase);
        }

        /**
         * It eliminates accentuation and unnecessary spaces,
         * then converts everything to lowercase letters.
         *
         * @var string
         */
        $slug = preg_replace(array(
            '/(á|à|ã|â|ä)/','/(Á|À|Ã|Â|Ä)/','/(é|è|ê|ë)/','/(É|È|Ê|Ë)/','/(í|ì|î|ï)/','/(Í|Ì|Î|Ï)/',
            '/(ó|ò|õ|ô|ö)/','/(Ó|Ò|Õ|Ô|Ö)/','/(ú|ù|û|ü)/','/(Ú|Ù|Û|Ü)/','/(ñ)/','/(Ñ)/'),
            explode(' ','a A e E i I o O u U n N'),
            str_replace(' ', $separator, preg_replace('/\s+/', ' ', strtolower($phrase)))
        );

        if ($inArray) {
            if (strrchr($slug, '.')) {

                $arr = explode('.', $slug);
                $phrase = $arr[0];
                $ext = '.' . $arr[1];

                return [$phrase, $ext];
            }
            return [$slug];
        }

        return $slug;
    }

}
