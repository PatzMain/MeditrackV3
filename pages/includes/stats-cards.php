<?php
/**
 * Stats Cards Display Component
 * Displays statistical cards based on configuration and data
 * 
 * Usage:
 * $pageKey = 'medicines';  // or 'supplies', 'equipment', etc.
 * include 'components/stats-cards.php';
 */

// Detect if inside patient_monitoring (depth 2)
$isMonitoring = strpos($_SERVER['PHP_SELF'], 'patient_monitoring/') !== false;

// Base path depending on depth
$basePath = $isMonitoring ? '../../../' : '../../';

// Load configuration
$config = include $basePath . 'config/stats_cards.php';

// Load statistics data
$stats = include $basePath . 'api/get_stats.php';

// Get configuration for current page
$pageKey = $pageKey ?? 'dashboard'; // Default to dashboard if not set
$cardsConfig = $config[$pageKey] ?? [];

// Display the stats cards
if (!empty($cardsConfig) && is_array($cardsConfig)): ?>
    <div class="stats-cards">
        <?php foreach ($cardsConfig as $cardConfig): ?>
            <?php
            // Get the data key and fetch value from stats
            $dataKey = $cardConfig['key'] ?? '';
            $value = $stats[$dataKey] ?? 0;
            
            // Get display properties
            $label = $cardConfig['label'] ?? 'N/A';
            $bgColor = $cardConfig['bgColor'] ?? '#f5f5f5';
            $svg = $cardConfig['svg'] ?? '';
            ?>
            
            <div class="stat-card" style="background-color: <?= htmlspecialchars($bgColor) ?>;">
                <div class="stat-icon">
                    <?php if (!empty($svg)): ?>
                        <?= $svg ?>
                    <?php endif; ?>
                </div>
                <div class="stat-info">
                    <div class="stat-value"><?= number_format($value) ?></div>
                    <div class="stat-label"><?= htmlspecialchars($label) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <style>
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        padding: 1.5rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .stat-icon {
        flex-shrink: 0;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-icon svg {
        width: 32px;
        height: 32px;
    }
    
    .stat-info {
        flex: 1;
        min-width: 0;
    }
    
    .stat-value {
        font-size: 1.875rem;
        font-weight: 700;
        line-height: 1.2;
        color: #1f2937;
    }
    
    .stat-label {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    
    @media (max-width: 768px) {
        .stats-cards {
            grid-template-columns: 1fr;
        }
        
        .stat-value {
            font-size: 1.5rem;
        }
    }
    </style>
<?php endif; ?>