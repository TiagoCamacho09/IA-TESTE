<?php
// tutor.php - Dashboard simplificado do tutor (DEPRECATED)
// Esta página foi substituída por resultados-tutor.php
// Mantida apenas por compatibilidade

require __DIR__ . '/includes/auth_tutor.php';

// Redirecionar para a nova página de resultados
header('Location: resultados-tutor.php');
exit;

