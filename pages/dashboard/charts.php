<?php
// pages/dashboard/charts.php
// Dashboard Charts Component
?>

<link rel="stylesheet" href="../css/charts.css">

<!-- Charts Section -->
<div class="charts-section">
    <div class="charts-header">
        <h2 class="charts-title">Analytics Dashboard</h2>
        <div class="charts-controls">
            <button class="chart-print-btn" onclick="openPrintModal()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19 8H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zm-3 11H8v-5h8v5zm3-7c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1zm-1-9H6v4h12V3z"/>
                </svg>
                Print Selected Charts
            </button>
        </div>
    </div>

    <div class="charts-grid">
        <!-- Daily Patient Consultations Trend -->
        <div class="chart-container full-width" id="consultation-trend-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Daily Patient Consultations (Last 30 Days)</h3>
                    <p class="chart-subtitle">Trend of daily patient consultations over the past month</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="consultation-trend">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="consultationTrendChart" class="chart-canvas"></canvas>
            </div>
            <div class="chart-stats" id="consultation-trend-stats">
                <div class="chart-stat">
                    <span class="chart-stat-value" id="total-consultations">-</span>
                    <span class="chart-stat-label">Total Consultations</span>
                </div>
                <div class="chart-stat">
                    <span class="chart-stat-value" id="avg-daily">-</span>
                    <span class="chart-stat-label">Daily Average</span>
                </div>
                <div class="chart-stat">
                    <span class="chart-stat-value" id="peak-day">-</span>
                    <span class="chart-stat-label">Peak Day</span>
                </div>
            </div>
        </div>

        <!-- Consultations by Course -->
        <div class="chart-container full-width" id="consultations-course-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Daily Consultations by Course</h3>
                    <p class="chart-subtitle">Multi-line chart showing consultation trends by course</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="consultations-course">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="consultationsCourseChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <!-- Consultations by Year Level -->
        <div class="chart-container full-width" id="consultations-level-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Daily Consultations by Year Level</h3>
                    <p class="chart-subtitle">Multi-line chart showing consultation trends by year level</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="consultations-level">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="consultationsLevelChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <!-- Student Distribution -->
        <div class="chart-container" id="student-distribution-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Student Distribution</h3>
                    <p class="chart-subtitle">Distribution by student type</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="student-distribution">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="studentDistributionChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <!-- Medicine Stock Levels -->
        <div class="chart-container" id="medicine-stock-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Medicine Stock Levels</h3>
                    <p class="chart-subtitle">Distribution of medicine stock levels</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="medicine-stock">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="medicineStockChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <!-- Equipment Condition -->
        <div class="chart-container" id="equipment-condition-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Equipment Condition</h3>
                    <p class="chart-subtitle">Current equipment status distribution</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="equipment-condition">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="equipmentConditionChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <!-- Activity Logs -->
        <div class="chart-container" id="activity-logs-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Activity Logs (Last 7 Days)</h3>
                    <p class="chart-subtitle">System activity by category</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="activity-logs">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="activityLogsChart" class="chart-canvas"></canvas>
            </div>
        </div>

        <!-- Monthly Admissions Trend -->
        <div class="chart-container full-width" id="monthly-admissions-container">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">Monthly Patient Admissions Trend</h3>
                    <p class="chart-subtitle">Patient admission trends over the past 12 months</p>
                </div>
                <label class="chart-checkbox">
                    <input type="checkbox" name="print-charts" value="monthly-admissions">
                    Include in Print
                </label>
            </div>
            <div class="chart-canvas-container">
                <canvas id="monthlyAdmissionsChart" class="chart-canvas"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Print Modal -->
<div id="printModal" class="print-modal">
    <div class="print-modal-content">
        <div class="print-modal-header">
            <h2 class="print-modal-title">Select Charts to Print</h2>
            <span class="print-modal-close" onclick="closePrintModal()">&times;</span>
        </div>
        <div class="print-modal-body">
            <p style="margin-bottom: 20px; color: var(--text-secondary);">
                Choose which charts you want to include in your printout:
            </p>
            <ul class="print-chart-list" id="printChartList">
                <!-- Chart options will be populated by JavaScript -->
            </ul>
            <div class="print-modal-actions">
                <button type="button" class="print-cancel-btn" onclick="closePrintModal()">Cancel</button>
                <button type="button" class="print-btn" onclick="printSelectedCharts()">Print Selected</button>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script>
// ========================================
// GLOBAL CHART VARIABLES
// ========================================
let chartInstances = {};
let chartData = {};

// ========================================
// CHART CONFIGURATIONS
// ========================================
const chartConfigs = {
    consultation_trend: {
        type: 'line',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                },
                point: {
                    radius: 4,
                    hoverRadius: 8
                }
            }
        }
    },
    consultations_by_course: {
        type: 'line',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                },
                point: {
                    radius: 3,
                    hoverRadius: 6
                }
            }
        }
    },
    consultations_by_level: {
        type: 'line',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                },
                point: {
                    radius: 3,
                    hoverRadius: 6
                }
            }
        }
    },
    student_distribution: {
        type: 'pie',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    },
    medicine_stock: {
        type: 'bar',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    },
    equipment_condition: {
        type: 'doughnut',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            cutout: '60%'
        }
    },
    activity_logs: {
        type: 'bar',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    },
    monthly_admissions: {
        type: 'line',
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: false
                },
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            elements: {
                line: {
                    tension: 0.4
                },
                point: {
                    radius: 4,
                    hoverRadius: 8
                }
            }
        }
    }
};

// ========================================
// CHART DATA PREPARATION
// ========================================
function prepareChartData(key, rawData) {
    const colors = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
        '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
    ];

    switch (key) {
        case 'consultation_trend':
            return {
                labels: rawData.labels,
                datasets: [{
                    label: 'Daily Consultations',
                    data: rawData.data,
                    borderColor: '#0f7b0f',
                    backgroundColor: 'rgba(15, 123, 15, 0.1)',
                    fill: true
                }]
            };

        case 'consultations_by_course':
        case 'consultations_by_level':
            return rawData;

        case 'student_distribution':
            return {
                labels: rawData.labels,
                datasets: [{
                    data: rawData.data,
                    backgroundColor: colors.slice(0, rawData.labels.length)
                }]
            };

        case 'medicine_stock':
            const stockColors = {
                'Out of Stock': '#dc3545',
                'Low Stock': '#fd7e14',
                'Medium Stock': '#ffc107',
                'High Stock': '#28a745'
            };
            return {
                labels: rawData.labels,
                datasets: [{
                    label: 'Medicine Count',
                    data: rawData.data,
                    backgroundColor: rawData.labels.map(label => stockColors[label] || '#6c757d')
                }]
            };

        case 'equipment_condition':
            const conditionColors = {
                'Available': '#28a745',
                'Occupied': '#ffc107',
                'Maintenance': '#dc3545'
            };
            return {
                labels: rawData.labels,
                datasets: [{
                    data: rawData.data,
                    backgroundColor: rawData.labels.map(label => conditionColors[label] || '#6c757d')
                }]
            };

        case 'activity_logs':
            return {
                labels: rawData.labels,
                datasets: [{
                    label: 'Activity Count',
                    data: rawData.data,
                    backgroundColor: colors.slice(0, rawData.labels.length)
                }]
            };

        case 'monthly_admissions':
            return {
                labels: rawData.labels,
                datasets: [{
                    label: 'Monthly Admissions',
                    data: rawData.data,
                    borderColor: '#0f7b0f',
                    backgroundColor: 'rgba(15, 123, 15, 0.1)',
                    fill: true
                }]
            };

        default:
            return rawData;
    }
}

// ========================================
// CHART CREATION
// ========================================
function createChart(canvasId, chartKey, data) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return null;

    const ctx = canvas.getContext('2d');
    const config = chartConfigs[chartKey];
    
    if (!config) return null;

    const preparedData = prepareChartData(chartKey, data);

    return new Chart(ctx, {
        type: config.type,
        data: preparedData,
        options: config.options
    });
}

// ========================================
// CHART LOADING AND ERROR HANDLING
// ========================================
function showChartLoading(containerId) {
    const container = document.getElementById(containerId);
    if (container) {
        const canvasContainer = container.querySelector('.chart-canvas-container');
        canvasContainer.innerHTML = '<div class="chart-loading">Loading chart data...</div>';
    }
}

function showChartError(containerId, error) {
    const container = document.getElementById(containerId);
    if (container) {
        const canvasContainer = container.querySelector('.chart-canvas-container');
        canvasContainer.innerHTML = `<div class="chart-error">Failed to load chart<br><small>${error}</small></div>`;
    }
}

// ========================================
// DATA FETCHING
// ========================================
async function fetchChartData() {
    try {
        const response = await fetch('../../api/chart_data.php');
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

// ========================================
// CHART INITIALIZATION
// ========================================
async function initializeCharts() {
    // Show loading state for all charts
    const chartContainers = [
        'consultation-trend-container',
        'consultations-course-container', 
        'consultations-level-container',
        'student-distribution-container',
        'medicine-stock-container',
        'equipment-condition-container',
        'activity-logs-container',
        'monthly-admissions-container'
    ];

    chartContainers.forEach(showChartLoading);

    try {
        const data = await fetchChartData();
        chartData = data;

        // Create charts
        if (data.consultation_trend) {
            chartInstances.consultationTrend = createChart(
                'consultationTrendChart', 
                'consultation_trend', 
                data.consultation_trend
            );
            
            // Update stats
            updateConsultationStats(data.consultation_trend);
        }

        if (data.consultations_by_course) {
            chartInstances.consultationsCourse = createChart(
                'consultationsCourseChart',
                'consultations_by_course',
                data.consultations_by_course
            );
        }

        if (data.consultations_by_level) {
            chartInstances.consultationsLevel = createChart(
                'consultationsLevelChart',
                'consultations_by_level', 
                data.consultations_by_level
            );
        }

        if (data.student_distribution) {
            chartInstances.studentDistribution = createChart(
                'studentDistributionChart',
                'student_distribution',
                data.student_distribution
            );
        }

        if (data.medicine_stock) {
            chartInstances.medicineStock = createChart(
                'medicineStockChart',
                'medicine_stock',
                data.medicine_stock
            );
        }

        if (data.equipment_condition) {
            chartInstances.equipmentCondition = createChart(
                'equipmentConditionChart',
                'equipment_condition',
                data.equipment_condition
            );
        }

        if (data.activity_logs) {
            chartInstances.activityLogs = createChart(
                'activityLogsChart',
                'activity_logs',
                data.activity_logs
            );
        }

        if (data.monthly_admissions) {
            chartInstances.monthlyAdmissions = createChart(
                'monthlyAdmissionsChart',
                'monthly_admissions',
                data.monthly_admissions
            );
        }

    } catch (error) {
        console.error('Failed to initialize charts:', error);
        chartContainers.forEach(containerId => {
            showChartError(containerId, error.message);
        });
    }
}

// ========================================
// STATISTICS UPDATE
// ========================================
function updateConsultationStats(data) {
    const totalConsultations = data.data.reduce((sum, val) => sum + val, 0);
    const avgDaily = totalConsultations > 0 ? (totalConsultations / data.data.length).toFixed(1) : 0;
    const maxIndex = data.data.indexOf(Math.max(...data.data));
    const peakDay = maxIndex >= 0 ? data.labels[maxIndex] : 'N/A';

    document.getElementById('total-consultations').textContent = totalConsultations;
    document.getElementById('avg-daily').textContent = avgDaily;
    document.getElementById('peak-day').textContent = peakDay;
}

// ========================================
// PRINT FUNCTIONALITY
// ========================================
function openPrintModal() {
    populatePrintChartList();
    document.getElementById('printModal').style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function closePrintModal() {
    document.getElementById('printModal').style.display = 'none';
    document.body.style.overflow = 'auto';
}

function populatePrintChartList() {
    const chartList = document.getElementById('printChartList');
    const checkboxes = document.querySelectorAll('input[name="print-charts"]');
    
    chartList.innerHTML = '';
    
    checkboxes.forEach(checkbox => {
        const container = checkbox.closest('.chart-container');
        const title = container.querySelector('.chart-title').textContent;
        
        const listItem = document.createElement('li');
        listItem.className = 'print-chart-item';
        listItem.innerHTML = `
            <input type="checkbox" id="print-${checkbox.value}" value="${checkbox.value}" ${checkbox.checked ? 'checked' : ''}>
            <label for="print-${checkbox.value}" class="print-chart-label">${title}</label>
        `;
        
        listItem.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                const cb = this.querySelector('input[type="checkbox"]');
                cb.checked = !cb.checked;
            }
        });
        
        chartList.appendChild(listItem);
    });
}

function printSelectedCharts() {
    const selectedCharts = [];
    const printCheckboxes = document.querySelectorAll('#printChartList input[type="checkbox"]:checked');
    
    printCheckboxes.forEach(checkbox => {
        selectedCharts.push(checkbox.value);
    });
    
    if (selectedCharts.length === 0) {
        alert('Please select at least one chart to print.');
        return;
    }
    
    // Hide non-selected charts
    const allChartContainers = document.querySelectorAll('.chart-container');
    allChartContainers.forEach(container => {
        const checkbox = container.querySelector('input[name="print-charts"]');
        if (checkbox && !selectedCharts.includes(checkbox.value)) {
            container.style.display = 'none';
        }
    });
    
    closePrintModal();
    
    // Print
    setTimeout(() => {
        window.print();
        
        // Restore visibility after print
        setTimeout(() => {
            allChartContainers.forEach(container => {
                container.style.display = '';
            });
        }, 1000);
    }, 500);
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePrintModal();
    }
});

// ========================================
// INITIALIZATION
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();
});
</script>