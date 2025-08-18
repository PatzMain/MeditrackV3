

<!-- Charts Section -->
<div class="charts-section">
    <div class="charts-grid">
        <!-- Inventory Overview Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Inventory Overview</h3>
                <div class="chart-subtitle">Current stock levels by category</div>
            </div>
            <div class="chart-wrapper">
                <canvas id="inventoryChart"></canvas>
            </div>
        </div>

        <!-- Equipment Status Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Equipment Status</h3>
                <div class="chart-subtitle">Current equipment conditions</div>
            </div>
            <div class="chart-wrapper">
                <canvas id="equipmentChart"></canvas>
            </div>
        </div>

        <!-- Monthly Activity Chart -->
        <div class="chart-container wide">
            <div class="chart-header">
                <h3 class="chart-title">Monthly Activity Trends</h3>
                <div class="chart-subtitle">Patient consultations and treatments over time</div>
            </div>
            <div class="chart-wrapper">
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <!-- Stock Alerts Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Stock Alerts</h3>
                <div class="chart-subtitle">Items requiring attention</div>
            </div>
            <div class="chart-wrapper">
                <canvas id="stockAlertsChart"></canvas>
            </div>
        </div>

        <!-- Patient Status Chart -->
        <div class="chart-container">
            <div class="chart-header">
                <h3 class="chart-title">Patient Status</h3>
                <div class="chart-subtitle">Current patient distribution</div>
            </div>
            <div class="chart-wrapper">
                <canvas id="patientChart"></canvas>
            </div>
        </div>

        <!-- Weekly Vital Signs Trend -->
        <div class="chart-container wide">
            <div class="chart-header">
                <h3 class="chart-title">Weekly Vital Signs Records</h3>
                <div class="chart-subtitle">Daily vital signs monitoring trends</div>
            </div>
            <div class="chart-wrapper">
                <canvas id="vitalSignsChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    // Dynamic Dashboard Charts Implementation
// File: pages/dashboard/charts.js
// Connected to database via MySQLi API

document.addEventListener('DOMContentLoaded', function() {
    // Chart.js default configuration
    Chart.defaults.responsive = true;
    Chart.defaults.maintainAspectRatio = false;
    Chart.defaults.plugins.legend.display = true;
    Chart.defaults.plugins.tooltip.enabled = true;

    // Color palette for consistency
    const colors = {
        primary: '#0f7b0f',
        secondary: '#00cc44',
        accent: '#4CAF50',
        warning: '#FF9800',
        danger: '#f44336',
        info: '#2196F3',
        success: '#4CAF50',
        light: '#f8f9fa',
        dark: '#343a40'
    };

    // Chart instances storage
    let chartInstances = {};

    // Loading state management
    function showLoadingState(chartId) {
        const canvas = document.getElementById(chartId);
        const wrapper = canvas.parentElement;
        wrapper.innerHTML = `
            <div class="chart-loading">
                <div class="loading-spinner"></div>
                Loading chart data...
            </div>
        `;
    }

    function showErrorState(chartId, error) {
        const wrapper = document.getElementById(chartId).parentElement;
        wrapper.innerHTML = `
            <div class="chart-error">
                <div class="chart-error-icon">⚠️</div>
                <div class="chart-error-message">Failed to load chart data</div>
                <div class="chart-error-details">${error}</div>
                <button onclick="loadChartData()" class="retry-btn">Retry</button>
            </div>
        `;
    }

    function restoreCanvas(chartId) {
        const wrapper = document.querySelector(`#${chartId}`).parentElement;
        wrapper.innerHTML = `<canvas id="${chartId}"></canvas>`;
    }

    // Fetch chart data from API
    async function fetchChartData() {
        try {
            const response = await fetch('get_chart_data.php');
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            
            if (data.error) {
                throw new Error(data.error);
            }
            
            return data;
        } catch (error) {
            console.error('Error fetching chart data:', error);
            throw error;
        }
    }

    // Create charts with real data
    function createCharts(data) {
        // 1. Inventory Overview Chart (Doughnut)
        if (data.inventory) {
            restoreCanvas('inventoryChart');
            const inventoryCtx = document.getElementById('inventoryChart').getContext('2d');
            chartInstances.inventory = new Chart(inventoryCtx, {
                type: 'doughnut',
                data: {
                    labels: data.inventory.labels,
                    datasets: [{
                        data: data.inventory.data,
                        backgroundColor: [
                            colors.primary,
                            colors.secondary,
                            colors.info,
                            colors.warning
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12,
                                    family: 'Inter'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${label}: ${value} items (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    layout: {
                        padding: 10
                    }
                }
            });
        }

        // 2. Equipment Status Chart (Pie)
        if (data.equipment_status) {
            restoreCanvas('equipmentChart');
            const equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
            chartInstances.equipment = new Chart(equipmentCtx, {
                type: 'pie',
                data: {
                    labels: data.equipment_status.labels,
                    datasets: [{
                        data: data.equipment_status.data,
                        backgroundColor: [
                            colors.success,
                            colors.warning,
                            colors.danger
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        hoverOffset: 6
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12,
                                    family: 'Inter'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    return `${label}: ${value} equipment`;
                                }
                            }
                        }
                    },
                    layout: {
                        padding: 10
                    }
                }
            });
        }

        // 3. Monthly Activity Chart (Line)
        if (data.monthly_activity) {
            restoreCanvas('activityChart');
            const activityCtx = document.getElementById('activityChart').getContext('2d');
            chartInstances.activity = new Chart(activityCtx, {
                type: 'line',
                data: {
                    labels: data.monthly_activity.labels,
                    datasets: [{
                        label: 'Medical Consultations',
                        data: data.monthly_activity.medical_consultations,
                        borderColor: colors.primary,
                        backgroundColor: colors.primary + '20',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }, {
                        label: 'Dental Consultations', 
                        data: data.monthly_activity.dental_consultations,
                        borderColor: colors.secondary,
                        backgroundColor: colors.secondary + '20',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }, {
                        label: 'Emergency Cases',
                        data: data.monthly_activity.emergency_cases,
                        borderColor: colors.danger,
                        backgroundColor: colors.danger + '20',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12,
                                    family: 'Inter'
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e9ecef'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: '#e9ecef'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }

        // 4. Stock Alerts Chart (Bar)
        if (data.stock_alerts) {
            restoreCanvas('stockAlertsChart');
            const stockAlertsCtx = document.getElementById('stockAlertsChart').getContext('2d');
            chartInstances.stockAlerts = new Chart(stockAlertsCtx, {
                type: 'bar',
                data: {
                    labels: data.stock_alerts.labels,
                    datasets: [{
                        label: 'Items',
                        data: data.stock_alerts.data,
                        backgroundColor: [
                            colors.warning,
                            colors.danger,
                            colors.info
                        ],
                        borderColor: [
                            colors.warning,
                            colors.danger,
                            colors.info
                        ],
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed.y} items`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e9ecef'
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    }
                }
            });
        }

        // 5. Patient Status Chart (Doughnut)
        if (data.patient_status) {
            restoreCanvas('patientChart');
            const patientCtx = document.getElementById('patientChart').getContext('2d');
            chartInstances.patient = new Chart(patientCtx, {
                type: 'doughnut',
                data: {
                    labels: data.patient_status.labels,
                    datasets: [{
                        data: data.patient_status.data,
                        backgroundColor: [
                            colors.info,
                            colors.success,
                            colors.warning
                        ],
                        borderColor: '#ffffff',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: {
                                    size: 12,
                                    family: 'Inter'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    return `${label}: ${value} patients`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    layout: {
                        padding: 10
                    }
                }
            });
        }

        // 6. Weekly Vital Signs Chart (Line)
        if (data.vital_signs) {
            restoreCanvas('vitalSignsChart');
            const vitalSignsCtx = document.getElementById('vitalSignsChart').getContext('2d');
            chartInstances.vitalSigns = new Chart(vitalSignsCtx, {
                type: 'line',
                data: {
                    labels: data.vital_signs.labels,
                    datasets: [{
                        label: 'Vital Signs Recorded',
                        data: data.vital_signs.data,
                        borderColor: colors.primary,
                        backgroundColor: colors.primary + '30',
                        fill: true,
                        tension: 0.4,
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        pointBackgroundColor: colors.primary,
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                title: function(context) {
                                    return context[0].label;
                                },
                                label: function(context) {
                                    return `${context.parsed.y} vital signs recorded`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e9ecef'
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 11
                                }
                            }
                        },
                        x: {
                            grid: {
                                color: '#e9ecef'
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    }
                }
            });
        }
    }

    // Main function to load and display charts
    async function loadChartData() {
        // Show loading states for all charts
        const chartIds = ['inventoryChart', 'equipmentChart', 'activityChart', 'stockAlertsChart', 'patientChart', 'vitalSignsChart'];
        chartIds.forEach(id => showLoadingState(id));

        try {
            const data = await fetchChartData();
            createCharts(data);
            addChartAnimations();
            console.log('Charts loaded successfully with real data');
        } catch (error) {
            console.error('Failed to load chart data:', error);
            chartIds.forEach(id => showErrorState(id, error.message));
        }
    }

    // Chart animation and interaction enhancements
    function addChartAnimations() {
        const chartContainers = document.querySelectorAll('.chart-container');
        
        chartContainers.forEach(container => {
            container.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-4px)';
                this.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.15)';
            });
            
            container.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
            });
        });
    }

    // Responsive chart updates
    function handleResize() {
        window.addEventListener('resize', function() {
            setTimeout(() => {
                Object.values(chartInstances).forEach(chart => {
                    if (chart && typeof chart.resize === 'function') {
                        chart.resize();
                    }
                });
            }, 100);
        });
    }

    // Refresh charts function
    window.refreshCharts = function() {
        // Destroy existing charts
        Object.values(chartInstances).forEach(chart => {
            if (chart && typeof chart.destroy === 'function') {
                chart.destroy();
            }
        });
        chartInstances = {};
        
        // Reload data
        loadChartData();
    };

    // Export chart data function
    window.exportChartData = function(chartId) {
        const chart = chartInstances[chartId];
        if (chart) {
            const data = chart.data;
            console.log(`${chartId} data:`, data);
            // Could implement CSV export here
        }
    };

    // Print charts function
    window.printCharts = function() {
        window.print();
    };

    // Auto-refresh charts every 5 minutes
    setInterval(window.refreshCharts, 300000);

    // Initialize responsive handling
    handleResize();

    // Load charts on page load
    loadChartData();

    // Make loadChartData available globally for retry buttons
    window.loadChartData = loadChartData;
});
</script>