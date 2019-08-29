<?php

if (!function_exists('extract_inline_img')) {
    /**
     * Extracts base64 encoded inline images from HTML text, save it to the harddrive
     * and replace them in `$text` with a public URL
     *
     * @param  string $text
     * @param  string $storagePath
     * @param  string $srcPath
     * @return string
     * @throws \Exception
     */
    function extract_inline_img(string $text, string $storagePath, string $srcPath, bool $optimize = false) : string
    {
        // init
        $matches = [];

        $found = preg_match_all(REGEX_IMG_BASE64_SRC, $text, $matches);
        if ($found > 0) {
            for ($i = 0; $i < $found; $i++) {
                $extension = $matches[1][$i];
                $imageData = base64_decode($matches[2][$i]);

                $filename = uniqid() . '.' . $extension;
                $filePath = str_finish($storagePath, '/') . $filename;

                if (!file_exists($storagePath)) {
                    mkdir($storagePath, $mode = 0777, $recursive = true);
                }

                // Save to harddrive
                $bytesWritten = file_put_contents($filePath, $imageData);
                if ($bytesWritten === 0) {
                    throw new \Exception('Could not write to folder');
                }

                if ($optimize === true && class_exists('ImageOptimizer')) {
                    \ImageOptimizer::optimize($filePath);
                }

                $srcFilePath = str_finish($srcPath, '/') . $filename;

                // replace in text
                $text = preg_replace(REGEX_IMG_BASE64_REPLACE, 'src="' . $srcFilePath . '"', $text);
            }
        }
        return $text;
    }
}
