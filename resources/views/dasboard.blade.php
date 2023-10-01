{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Tableau de bord')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <ol class="breadcrumb hide-phone p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Gestion de Parrainnage</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Tableau de Bord</h4>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row">
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
                            <h5 class="mt-0">{{ $nbCarte->nb }}</h5>
                      <a href="{{ route('carte.by.region') }}"><p class="mb-0 text-muted">Nombre de Carte de Collecté{{--  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>  --}}</p></a>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar  bg-success" role="progressbar" style="width: {{ ($nbCarte->nb/60000)*100  }}%;" aria-valuenow="{ ($nbCarte->nb/60000)*100  }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">Nombre de cartes Par Region</div>
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
</div>

<div class="col-sm-8">
    <div class="card">
        <div class="card-header">Nombre de cartes Par Collecteur</div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-responsive-md table-striped text-center">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Nombre de cartes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($cartesParCollecteurs as $carteParCollecteur)
                    <tr>
                        <td>{{ $carteParCollecteur->nom}}</td>
                        <td>{{ $carteParCollecteur->nb }}</td>
                        <td>
                            <a href="{{ route('carte.by.collecteur', ['id'=>$carteParCollecteur->id,'nom'=>$carteParCollecteur->nom]) }}" role="button" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                        </td>

                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="card">
        <div class="card-header">Nombre de cartes Par Collecteur</div>
        <div class="card-body">
            <canvas id="myChartc"></canvas>
        </div>
    </div>
</div>
</div>

@endsection


@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    var label = ["min","collecté","max"];
    var donnee = [40000,{{ $nbCarte->nb }},60000];

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: label,
      datasets: [{
        label: '#nombre de cartes ',
        data:donnee,
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)'
          ],
          borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)'
          ],
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
  const ctxc = document.getElementById('myChartc');
    var labelc = [];
    var donneec = [];
    @foreach ($cartesParCollecteurs as $cartesParCollecteur)
    labelc.push("{{ $cartesParCollecteur->nom }}")
    donneec.push("{{ $cartesParCollecteur->nb }}")
    new Chart(ctxc, {
        type: 'pie',
        data: {
          labels: labelc,
          datasets: [{
            label: '#nombre de cartes',
            data:donneec,
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
@endforeach
</script>
@endsection
