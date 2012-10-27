<?php

namespace Benji07\BlogBundle;

use Knp\Bundle\MarkdownBundle\Parser\MarkdownParser as BaseMarkdownParser;

/**
 * Markdown parser to highlight code
 */
class MarkdownParser extends BaseMarkdownParser
{
    /**
     * We found a code block
     *
     * @param string $matches the string found
     *
     * @return string
     */
    public function _doCodeBlocks_callback($matches)
    {
        $codeblock = $matches[1];

        $codeblock = $this->outdent($codeblock);
        //$codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);
        // trim leading newlines and trailing newlines
        $codeblock = preg_replace('/\A\n+|\n+\z/', '', $codeblock);

        //$codeblock = "<pre><code>$codeblock\n</code></pre>";
        // if it start w/ a language tag,
        if (preg_match('/^\[(\w+)\]\s*/', $codeblock, $match)) {
            $codeblock = str_replace("[${match[1]}]\n", '', $codeblock);
            $lang = $match[1];

            $codeblock = '<pre class="prettyprint language-'.$lang.'">'.htmlentities($codeblock).'</pre>';
        } else {
            $codeblock = htmlspecialchars($codeblock, ENT_NOQUOTES);
            $codeblock = '<pre class="prettyprint">'.$codeblock.'</pre>';
        }

        return "\n\n" . $this->hashBlock($codeblock) . "\n\n";
    }
}
