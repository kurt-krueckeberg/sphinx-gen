<?php

/*
 A more robust option: preg_replace_callback()

If you want to guard against typos in the template (a placeholder name that
doesn't exist in your array) or want more control, a regex-based approach
lets you validate as you go:

This scans for anything matching `{word}`, and for each match, looks it up
in your array. The advantage over `strtr()`/`str_replace()` is that a
mistyped placeholder (like `{image_number}` when your array only has
`image_no`) throws an error immediately instead of silently leaving the
literal `{image_number}` text sitting in your output — which is easy to
miss when you're generating citations in bulk.

Any of these three works correctly for your use case. I'd lean toward
`strtr()` with braces for simplicity, or the `preg_replace_callback()`
version if you're processing a lot of these programmatically and want to
catch mismatches early.
 */

function subst_variables(string $template, array $key_value_pairs)
{
    return preg_replace_callback(
        '/\{(\w+)\}/',
        function ($matches) use ($key_value_pairs) {
            $key = $matches[1];
            if (!array_key_exists($key, $key_value_pairs)) {
                throw new InvalidArgumentException("Unknown placeholder: {$key}");
            }
            return $key_value_pairs[$key];
        },
        $template
    );
}


