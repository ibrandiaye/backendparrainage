{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Tableau de bord')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Gestion de Parrainnage</a></li>
                    <li class="breadcrumb-item active">Dashboard Region</li>
                </ol>
            </div>
            <h4 class="page-title">Tableau de Bord</h4>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row">
    @foreach ( $nbCartesParRegion as $nbCartesParRegio)

    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round">
                            <i class="mdi mdi-map-marker"></i>
                        </div>
                    </div>
                    <div class="col-9 align-self-center text-right">
                        <div class="m-l-10">
                            <h5 class="mt-0">{{ $nbCartesParRegio->nb }}</h5>
                      <a href="{{ route('carte.by.departement', ['id'=>$nbCartesParRegio->id,'nom'=>$nbCartesParRegio->nom,]) }}"><p class="mb-0 text-muted">{{  $nbCartesParRegio->nom }} {{--  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>  --}}</p></a>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar  bg-success" role="progressbar" style="width: {{ ($nbCartesParRegio->nb/2000)*100  }}%;" aria-valuenow=" {{ ($nbCartesParRegio->nb/2000)*100  }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    @endforeach
</div>

<div class="row">
    <div class="col-sm-12">
    <div class="card">
        <div class="card-header">Nombre de cartes Par Region</div>
        <div class="card-body">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

</div>

@endsection


@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    var label = [];
    var donnee = [];
    @foreach ($nbCartesParRegion as $nbCartesParRegio)
        label.push("{{ $nbCartesParRegio->nom }}")
        donnee.push("{{ $nbCartesParRegio->nb }}")
    @endforeach
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: label,
      datasets: [{
        label: '#nombre de cartes',
        data:donnee,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

</script>
@endsection
