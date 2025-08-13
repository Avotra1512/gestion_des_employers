@extends('layouts.template')

@section('content')
<h1 class="app-page-title" style="color: #2F7693">Gestion des Employers</h1>

<div class="row g-4 mb-4">
    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Sérvices</h4>
                <div class="stats-figure">{{ $totalDepartements }}</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Employers</h4>
                <div class="stats-figure">{{ $totalEmployers }}</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Administrateur</h4>
                <div class="stats-figure">{{ $totalAdministrateurs }}</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Employés payés aujourd'hui</h4>
                <div class="stats-figure">{{ $totalPayé }}</div>
            </div>
        </div>
    </div>
</div>

<div class="app-branding">
    <div class="row g-4 mb-4">
        <!-- Courbe 1 -->
        <div class="col-12 col-lg-6">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3 border-0">
                    <h4 class="app-card-title">Le nombre d’employés par service</h4>
                </div>
                <div class="app-card-body p-4">
                    <div class="chart-container">
                        <canvas id="chart-line"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Courbe 2 -->
        <div class="col-12 col-lg-6">
            <div class="app-card app-card-chart h-100 shadow-sm">
                <div class="app-card-header p-3 border-0">
                    <h4 class="app-card-title">Évolution des paiements par jour</h4>
                </div>
                <div class="app-card-body p-4">
                    <div class="chart-container">
                        <canvas id="chart-bar"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// 🔹 Courbe 1 : Employés par service (Line Chart)
const serviceLabels = {!! json_encode($serviceLabels) !!};
const serviceData = {!! json_encode($serviceData) !!};

const ctxLine = document.getElementById('chart-line').getContext('2d');
new Chart(ctxLine, {
    type: 'line',
    data: {
        labels: serviceLabels,
        datasets: [{
            label: 'Nombre d\'employés',
            data: serviceData,
            borderColor: '#2F7693',
            fill: false,
            tension: 0.4
        }]
    },

    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Nombre d\'employés: ' + context.formattedValue;
                    }
                }
            }
        },
        scales: {
            y: { beginAtZero: true, ticks: { precision: 0 } }
        }
    }
});

// 🔹 Courbe 2 : Paiements par jour (Bar Chart)
const paiementLabels = {!! json_encode($paiementLabels) !!};
const paiementData = {!! json_encode($paiementData) !!};

const ctxBar = document.getElementById('chart-bar').getContext('2d');
new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: paiementLabels,
        datasets: [{
            label: 'Montant total payé',
            data: paiementData,
            backgroundColor: '#2F7693',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: true, position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return 'Total payé: ' + context.formattedValue + ' Ar';
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value + ' Ar';
                    }
                }
            }
        }
    }
});
</script>
@endsection
