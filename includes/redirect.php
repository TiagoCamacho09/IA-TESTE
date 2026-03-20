<?php
// includes/redirect.php
// Helper para redirects com URLs absolutas, evitando problemas de redirecionamento relativo.

function safe_redirect(string $path): void {
    // Evitar redirecionamentos abertos e garantir a URL é relativa/segura.
    $path = trim($path);
    if ($path === '') {
        $path = 'index.php';
    }

    // If the path is external URL, fallback to index
    if (preg_match('/^https?:\/\//i', $path)) {
        $path = 'index.php';
    }

    // Enviar redirecionamento com saída imediata
    header('Location: ' . $path);
    exit;
}
