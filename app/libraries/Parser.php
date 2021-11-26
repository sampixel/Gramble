<?php

/**
 * @package app\libraries
 * @license https://mit-license.org/ MIT License
 * @author  Samuel Reka <rekasamuel0@gmail.com>
 */

namespace app\libraries;

/**
 * Class Parser
 */
class Parser {

    /**
     * Recursive function that iterates each folder
     * to find the given basename relative path.
     * @param string $base The basename file
     * @param string $path The absolute pathname
     * @return string The relative pathname
     */
    public function findFile($base, $path) {
        foreach (new \DirectoryIterator($path) as $file) {
            $pathname = $file->getPathname();
            $extension = $file->getExtension();
            if (!$file->isDot() && $file->isDir()) {
                $this->findFile($base, $pathname);
            } elseif (!$file->isDot() && !$file->isDir()) {
                if ($base === $file->getBasename("." . $extension)) {
                    $pos = strpos($pathname, $extension . "/");
                    if ($pos !== false) {
                        $realPath = substr($pathname, $pos);
                    }
                    
                    return $realPath;
                }
            }
        }
    }

}