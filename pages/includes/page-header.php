<?php
// Detect if inside patient_monitoring (depth 2)
$isMonitoring = strpos($_SERVER['PHP_SELF'], 'patient_monitoring/') !== false;

// Base path depending on depth
$basePath = $isMonitoring ? '../../../' : '../../';

// Load page configuration
$pagesConfig = include $basePath . 'config/pages.php';

$pageData = $pagesConfig[$pageKey] ?? ['title' => 'Untitled', 'subtitle' => ''];

?>
<div class="page-header">
    <h1 class="page-title"><?php echo htmlspecialchars($pageData['title']); ?></h1>
    <p class="section-subtitle"><?php echo htmlspecialchars($pageData['subtitle']); ?></p>
</div>