<?php

namespace Codingfogey\Bundle\FontAwesomeBundle\Utility;

class PathUtility
{
    /**
     * @link http://stackoverflow.com/a/2638272/776654
     */
    public function getRelativePath($from, $to)
    {
        $from = is_dir($from) ? rtrim($from, '\/') . '/' : $from;
        $to   = is_dir($to)   ? rtrim($to, '\/') . '/'   : $to;

        $normalizedFrom = str_replace('\\', '/', $from);
        $normalizedTo   = str_replace('\\', '/', $to);

        $fromArray     = explode('/', $normalizedFrom);
        $toArray      = explode('/', $normalizedTo);

        $relPath  = $toArray;

        foreach ($fromArray as $depth => $dir) {
            if ($dir === $toArray[$depth]) {
                array_shift($relPath);
            } else {
                $remaining = count($fromArray) - $depth;
                if ($remaining > 1) {
                    $padLength = (count($relPath) + $remaining - 1) * -1;
                    $relPath = array_pad($relPath, $padLength, '..');
                    break;
                } else {
                    $relPath[0] = './' . $relPath[0];
                }
            }
        }
        return implode('/', $relPath);
    }

}
