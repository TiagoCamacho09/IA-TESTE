<?php
// includes/redirect.php
// Helper para redirects com URLs absolutas, evitando problemas de redirecionamento relativo.

function safe_redirect(string $path): void {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $url = $scheme . '://' . $host . ($base === '/' ? '' : $base) . '/' . ltrim($path, '/');

    header('Location: ' . $url);
    exit;
}
