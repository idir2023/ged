@extends('layouts.master')

@section('title')
  @lang('sidebar.dashboard')
@endsection

@section('css')
  <!-- Lightbox css -->
  <link href="{{ asset('/assets/libs/magnific-popup/magnific-popup.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Chart.js css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.css" />
@endsection

@section('content')

  @component('components.breadcrumb')
    @slot('li_1') Dashboards @endslot
    @slot('title') Dashboard @endslot
  @endcomponent

  <!-- Stats Row -->
  <div class="row">
    <div class="col-xl-12">
      <div class="row">

        <!-- Contact Card -->
        <div class="col-md-4">
          <div class="card mini-stats-wid">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <p class="text-muted fw-medium">@lang('Contact')</p>
                  <h4 class="mb-0">{{ $count_contact ?? 0 }}</h4> <!-- Vérification pour éviter les erreurs -->
                </div>
                <div class="align-self-center flex-shrink-0">
                  <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-phone font-size-24"></i> <!-- Icône correcte -->
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Ajout d'autres cartes si nécessaire -->
        
      </div>
    </div>
  </div>

  <!-- Charts Section -->
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Dashboard Charts</h4>
          <canvas id="dashboardChart" style="height: 300px;"></canvas>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('script')
  <!-- Chart.js Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var ctx = document.getElementById("dashboardChart").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "May"],
          datasets: [{
            label: "Data Example",
            data: [10, 20, 30, 40, 50],
            backgroundColor: "rgba(54, 162, 235, 0.6)",
            borderColor: "rgba(54, 162, 235, 1)",
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    });
  </script>
@endsection
