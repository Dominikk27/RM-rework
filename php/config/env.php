<?php

function loadEnv(string $path): void {
    if (!file_exists($path)) {
        throw new RuntimeException(".env súbor nenájdený: $path");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $line = trim($line);

        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }

        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");  

        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}