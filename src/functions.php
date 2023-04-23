<?php

namespace Withinboredom\NameOf;

function nameof($var): string
{
    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
    $lineNum = $backtrace[0]['line'];
    $file = $backtrace[0]['file'];
    $file = fopen($file, 'rb');
    // seek to the appropriate line number
    for($i = 0; $i < $lineNum-1; $i++) {
        fgets($file);
    }
    $line = fgets($file);
    fclose($file);

    // sanity check
    $first = strpos($line, 'nameof(');
    $last = strrpos($line, 'nameof(');
    if($first !== $last) {
        throw new \LogicException('There are multiple calls to nameof on the same line');
    }

    // get the variable name
    preg_match('/nameof\s+?\((.*?)\)/', $line, $matches);
    if(str_ends_with($matches[1], '(')) {
        $matches[1] .= ')';
    }

    return trim($matches[1], '$ ');
}
