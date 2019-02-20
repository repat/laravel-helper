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
        foreach ((array)$protocols as $protocol) {
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
