<?php

function bb_parse($content, $nl2br = true)
{
    $pattern = array(
        "/\[h\](.*)\[\/h\]/is",
        "/\[b\](.*)\[\/b\]/is",
        "/\[u\](.*)\[\/u\]/is",
        "/\[i\](.*)\[\/i\]/is",
        "/\[quote\](.*)\[\/quote\]/is",
        "/\[code\](.*)\[\/code\]/is",
        "/\[color=([^\[\<]+?)\](.*)\[\/color\]/is",
        "/\[font=([^\[\<]+?)\](.*)\[\/font\]/is",
        "/\[size=(\d+?)\](.*)\[\/size\]/is",
        "/\[url\](.*)\[\/url\]/i",
        "/\[url=(.*)\](.*)\[\/url\]/i",
        "/\[flash=(\d+),(\d+)\]\s*([^\[\<\r\n]+?)\s*\[\/flash\]/i",
        "/\[swf\]\s*([^\[\<\r\n]+?)\s*\[\/swf\]/i",
        "/\[img=\s*([^\[\<\r\n]+?)\s*\](.*)\[\/img\]/i",
        "/\[ul\](.*)\[\/ul\]/is",
        "/\[li\](.*)\[\/li\]/i",
    );

    $replacement = array(
        "<h3>\\1</h3>",
        "<b>\\1</b>",
        "<u>\\1</u>",
        "<i>\\1</i>",
        "<blockquote>\\1</blockquote>",
        "<pre><code>\\1</code></pre>",
        "<font color=\"\\1\">\\2</font>",
        "<font face=\"\\1\">\\2</font>",
        "<font size=\"\\1\">\\2</font>",
        "<a href=\"\\1\" target=\"_blank\">\\1</a>",
        "<a href=\"\\1\" target=\"_blank\">\\2</a>",
        "<p><embed width=\"\\1\" height=\"\\2\" src=\"\\3\"></embed></p>",
        "<p><embed width=\"500\" height=\"400\" src=\"\\1\"></embed></p>",
        "<figure class=\"figure\"><a href=\"\\1\" target=\"_blank\"><img class=\"img-responsive max-width: 40%; height: auto;\" src=\"\\1\" alt=\"\\1\" border=\"0\" /><figcaption class=\"figure-caption\">\\2</figcaption></a></figure>",
        "<ul>\\1</ul>",
        "<li>\\1</li>",
    );

    $content = preg_replace($pattern, $replacement, $content);
    $content = $nl2br === true ? nl2br($content) : $content;

    return $content;
}
