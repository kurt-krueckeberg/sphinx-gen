<?php
declare(strict_types=1);

$str = "# |%year |%name |Baptism";

$tok = strtok($str, "|");

while ($tok !== false) {
    $parts[] = $tok;
    $tok = strtok("|");
}

print_r($parts);
