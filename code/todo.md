# Implementation Notes

Use this code to replace the variables that are delimited with "{}".

```code
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
```
