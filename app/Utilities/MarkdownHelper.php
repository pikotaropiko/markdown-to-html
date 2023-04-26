<?php

namespace App\Utilities;

/**
 * @class MarkdownHelper
 * @package App\Utilities
 */
class MarkdownHelper
{
    /**
     * Converts markdown string to html code
     * @param string|null $text
     * @return string
     */
    public static function toHtml(?string $text): string
    {
        // if the input is empty return empty string
        if (empty($text)) {
            return '';
        }

        // Initialize output, paragraph variables and split text into lines
        $output = "";
        $inParagraph = false;
        $lines = explode("\n", $text);

        // Loop through lines
        foreach ($lines as $line) {
            // Replace links
            $line = preg_replace('/\[(.*?)\]\((.*?)\)/s', '<a href="$2">$1</a>', $line);

            // Check if line starts with # and replace with heading, else if line empty  - adjust closing p tag,
            // else - wrap line in paragraph
            if (preg_match('/^#+\s*(.*)$/', $line, $matches)) {
                $headingLevel = min(strlen($matches[0]) - strlen(ltrim($matches[0], '#')), 6);
                $headingText = trim($matches[1]);
                $output .= "<h$headingLevel>$headingText</h$headingLevel>\n";
                $inParagraph = false;
            } elseif (empty($line)) {
                if ($inParagraph) {
                    // remove last '\n'
                    $output = rtrim($output);
                    // close paragraph and add new line
                    $output .= "</p>\n";
                    $inParagraph = false;
                }
            } else {
                // If not already in a paragraph, start one
                if (!$inParagraph) {
                    $output .= "<p>";
                    $inParagraph = true;
                }
                // Add line to current paragraph, checking if it needs to replace url markdown
                $output .= "$line\n";
            }
        }

        // Close final paragraph if necessary
        if ($inParagraph) {
            // remove last '\n'
            $output = rtrim($output);
            // close paragraph and add new line
            $output .= "</p>\n";
        }

        return $output;
    }
}
