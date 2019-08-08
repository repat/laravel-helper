<?php

if (!function_exists('linkify')) {
    /**
     * Turn all URLs in clickable links.
     *
     * Possible URLs: `http/https`, `ftp`, `mail`, `twitter`
     *
     * Source: https://gist.github.com/jasny/2000705
     *
     * @param string $value
     * @param array  $protocols
     * @param array  $attributes
     * @return string
     */
    function linkify(?string $value, array $protocols = ['http', 'http', 'mail'], array $attributes = [])
    {
        if (is_null($value)) {
            return '';
        }

        // Link attributes
        $attr = '';
        foreach ($attributes as $key => $val) {
            $attr = ' ' . $key . '="' . htmlentities($val) . '"';
        }

        $links = [];

        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) {
            return '<' . array_push($links, $match[1]) . '>';
        }, $value);

        // Extract text links for each protocol
        foreach ($protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    if ($match[1]) {
                        $protocol = $match[1];
                    }
                    $link = $match[2] ?: $match[3];
                    return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>';
                }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) {
                    return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>';
                }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) {
                    return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>';
                }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) {
                    return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>';
                }, $value); break;
            }
        }

        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) {
            return $links[$match[1] - 1];
        }, $value);
    }
}

if (!function_exists('embedded_video_url')) {
    /**
     * Returns the embeddable video URL for YouTube and Vimeo video links
     * @param  string $url
     * @return string
     */
    function embedded_video_url(string $url) : string
    {
        // init
        $matches = [];
        $success = 0;

        if (str_contains($url, 'youtube') || str_contains($url, 'youtu.be')) {
            $success = preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
        } elseif (str_contains($url, 'vimeo')) {
            $success = preg_match('/vimeo\.com\/([\d]+)/', $url, $matches);
        }

        if ($success && count($matches) >= 2) {
            if (str_contains($url, 'youtube')) {
                return 'https://www.youtube.com/embed/' . $matches[1];
            } elseif (str_contains($url, 'vimeo')) {
                return 'https://player.vimeo.com/video/' . $matches[1];
            }
        } else {
            return '';
        }
    }
}

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

if (!function_exists('ul_li_unpack')) {
    /**
     * Unpacks an array by recursively using `<ul>` and `<li>`
     *
     * @param array $array
     * @return void
     */
    function ul_li_unpack(array $array, $separator = ':')
    {
        echo '<ul>';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                ul_li_unpack($value);
            } else {
                echo '<li>' . $key . trim($separator) . ' ' . $value . '</li>';
            }
        }
        echo '</ul>';
    }
}

if (!function_exists('html_link')) {
    /**
     * Links/Form with specific HTTP Verb (WIP, undocumented)
     *
     * @param  string $route
     * @param  string $description
     * @param  string $method
     * @param  array $inputs
     * @return string|null
     */
    function html_link(string $route, string $description, string $method = 'get', array $inputs = [], array $attributes = []) : ?string
    {
        $method = strtolower($method);

        if (!in_array($method, HTTP_VERBS)) {
            return null;
        }

        switch ($method) {
            case 'get':
                $tmp = trim(implode(' ', $attributes));
                return '<a href="' . $route . '" ' . $tmp . '>' . $description . '</a>';#
            break;
            case 'delete':
            case 'post':
            case 'put':
                $link = '<form action="' . $route . '" method="POST">' . PHP_EOL;
                $link .= '<input type="hidden" id="method" name="method" value="' . strtoupper($method) . '">' . PHP_EOL;
                foreach ($inputs as $id => $value) {
                    $link .= '<input type="hidden" id="' . $id . '" name="' . $id . ' " value="' . $value . '">' . PHP_EOL;
                }
                $link .= '<input style="background:none!important;border:none;padding:0!important;" type="submit" value="' . $description . '">' . PHP_EOL;
                $link .= '</form>' . PHP_EOL;
                return $link;
            break;
            default:
            return null;
        }
    }
}

if (!function_exists('contrast_color')) {
    /**
     * Determines whether or not black or white would be the best
     * contrast color for a background color. Based on Luminosity Contrast Algo:
     * https://stackoverflow.com/a/42921358/2517690
     *
     * @param  string $bgColor
     * @return string
     */
    function contrast_color(string $bgColor) : string
    {
        $bgColor = str_start($bgColor, '#');

        // hexColor RGB
        $r1 = hexdec(substr($bgColor, 1, 2));
        $g1 = hexdec(substr($bgColor, 3, 2));
        $b1 = hexdec(substr($bgColor, 5, 2));

        // Black RGB
        $blackColor = '#000000';
        $r2BlackColor = hexdec(substr($blackColor, 1, 2));
        $g2BlackColor = hexdec(substr($blackColor, 3, 2));
        $b2BlackColor = hexdec(substr($blackColor, 5, 2));

        // Calc contrast ratio
        $L1 = 0.2126 * pow($r1 / 255, 2.2) +
               0.7152 * pow($g1 / 255, 2.2) +
               0.0722 * pow($b1 / 255, 2.2);

        $L2 = 0.2126 * pow($r2BlackColor / 255, 2.2) +
              0.7152 * pow($g2BlackColor / 255, 2.2) +
              0.0722 * pow($b2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
        }

        // If contrast is more than 5, return black color
        if ($contrastRatio > 5) {
            return HEX_BLACK;
        } else {
            // if not, return white color.
            return HEX_WHITE;
        }
    }
}
