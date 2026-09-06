# Demo Code using `preg_replace_callback()` to replace `{}` deleimited variables

```php
<?php

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

// --- Example 1: normal, successful call ---

$arr = [
    'volume_name'  => "Verzeichnis der Getrauten und Gestorbenen 1641-1784",
    'image_no'     => 44,
    'total_images' => 239,
];

$citation = '{volume_name}, image {image_no} of {total_images}';
$x = subst_variables($citation, $arr);
echo $x . "\n";

// Example 2: a template with a typo'd placeholder ---
// Note: {image_number} doesn't exist in $arr (the key is actually 'image_no')

$bad_citation = '{volume_name}, image {image_number} of {total_images}';

try {
    $y = subst_variables($bad_citation, $arr);
    echo $y . "\n";

} catch (InvalidArgumentException $e) {

    echo "Error: " . $e->getMessage() . "\n";
}
```

**Output:**
```
Verzeichnis der Getrauten und Gestorbenen 1641-1784, image 44 of 239
Error: Unknown placeholder: image_number
```

## What's happening, step by step

1. `subst_variables()` calls `preg_replace_callback()`, passing it the regex `/\{(\w+)\}/`, an anonymous callback function, and the template string.
2. `preg_replace_callback()` scans `$template` for every substring matching that pattern — a `{`, followed by one or more "word" characters (letters/digits/underscore), followed by `}`.
3. For **each match found**, it calls your anonymous callback function once, passing in `$matches` — an array where `$matches[0]` is the whole match (e.g. `{volume_name}`) and `$matches[1]` is just the captured group inside the parentheses (e.g. `volume_name`).
4. Your callback checks whether that key exists in `$key_value_pairs`. If it does, it returns the corresponding value, and `preg_replace_callback()` substitutes that value back into the string in place of the matched placeholder. If the key doesn't exist, it throws an exception instead of silently leaving broken text in your output.
5. This repeats for every placeholder found, and the fully-substituted string is returned.

This is why it's called "more robust" — with `strtr()` or `str_replace()`,
a typo like `{image_number}` would just be silently left in your output as
literal text, which you might not notice until you're staring at a broken
citation later. Here, it fails loudly and immediately, telling you exactly
which placeholder was the problem.
