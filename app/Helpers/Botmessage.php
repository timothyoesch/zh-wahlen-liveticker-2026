<?php
use League\HTMLToMarkdown\HtmlConverter;

/**
 * Converts standard Markdown to Telegram's MarkdownV2 format.
 * * @param string $text The raw Markdown text.
 * @return string The escaped and formatted string for Telegram.
 */
function toMarkdownV2($text) {
    // 1. Characters that MUST be escaped if they aren't part of a tag:
    // _ * [ ] ( ) ~ ` > # + - = | { } . !
    $specialChars = ['_', '*', '[', ']', '(', ')', '~', '`', '>', '#', '+', '-', '=', '|', '{', '}', '.', '!'];

    // We escape them globally first.
    foreach ($specialChars as $char) {
        $text = str_replace($char, '\\' . $char, $text);
    }

    // 2. "Un-escape" and fix the actual formatting markers
    // Note: We search for the escaped versions (e.g., \*\*) and replace them
    // with the single-character Telegram equivalent where necessary.

    // Bold: \*\*text\*\* -> *text*
    $text = preg_replace('/\\\\\*\\\\\*(.*?)\\\\\*\\\\\*/s', '*$1*', $text);

    // Italics: \*text\* -> _text_ OR \_text\_ -> _text_
    // Telegram's V2 uses single _ for italics.
    $text = preg_replace('/(?<!\\\\)\\\\\*(.*?)(?<!\\\\)\\\\\*/s', '_$1_', $text);
    $text = preg_replace('/\\\\_(.*?)\\\\_/s', '_$1_', $text);

    // Code blocks: \`\`\`text\`\`\` -> ```text```
    $text = preg_replace('/\\\\`\\\\`\\\\`(.*?)\\\\`\\\\`\\\\`/s', '```$1```', $text);

    // Inline code: \`text\` -> `text`
    $text = preg_replace('/\\\\`(.*?)\\\\`/s', '`$1`', $text);

    // Strikethrough: \~\~text\~\~ -> ~text~
    $text = preg_replace('/\\\\~\\\\~(.*?)\\\\~\\\\~/s', '~$1~', $text);

    // Links: \[text\]\(url\) -> [text](url)
    // We need to be careful with the URL itself (it shouldn't have double-escaped backslashes)
    $text = preg_replace('/\\\\\[(.*?)\\\\\]\\\\ \((.*?)\\\\ \)/s', '[$1]($2)', $text);

    return $text;
}

function htmlToMarkdownV2($html) {
    $converter = new HtmlConverter();
    $markdown = $converter->convert($html);
    return $markdown;
}
?>
