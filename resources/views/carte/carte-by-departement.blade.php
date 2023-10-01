{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Tableau de bord')
@section("css")

<!-- DataTables -->
<link href="{{ asset('plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
    @foreach ( $nbCarteGroupByDepartementByRegions as $nbCarteGroupByDepartementByRegion)

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
                            <h5 class="mt-0">{{ $nbCarteGroupByDepartementByRegion->nb }}</h5>
                            <p class="mb-0 text-muted">{{  $nbCarteGroupByDepartementByRegion->nom }} {{--  <span class="badge bg-soft-success"><i class="mdi mdi-arrow-up"></i>2.35%</span>  --}}</p>
                        </div>
                    </div>
                </div>
                <div class="progress mt-3" style="height:3px;">
                    <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div><!--end card-body-->
        </div><!--end card-->
    </div><!--end col-->
    @endforeach
    <div class="col-sm-4">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('pdf.by.region', ['id'=>$id]) }}" class="btn btn-primary">Generer PDF</a>
                <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>N° de la carte d'électeur</th>
                        <th>Numéro d'Identification National</th>
                        <th>Date Expiration</th>
                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($carteByRegions as $carteByRegion)
                            <tr>
                                <td>{{ $carteByRegion->id  }}</td>
                                <td>{{ $carteByRegion->prenom  }}</td>
                                <td>{{ $carteByRegion->nom  }}</td>
                                <td>{{ $carteByRegion->numelec  }}</td>
                                <td>{{ $carteByRegion->numcni  }}</td>
                                <td>{{ date('d-m-Y', strtotime( $carteByRegion->expiration)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
    @foreach ($nbCarteGroupByDepartementByRegions as $nbCarteGroupByDepartementByRegion)
        label.push("{{ $nbCarteGroupByDepartementByRegion->nom }}")
        donnee.push("{{ $nbCarteGroupByDepartementByRegion->nb }}")
    @endforeach
  new Chart(ctx, {
    type: 'pie',
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
<!-- Required datatable js -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
        <!-- Buttons examples -->
        <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/buttons.colVis.min.js') }}"></script>
        <!-- Responsive examples -->
        <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
        <script>
        $(document).ready(function() {
            $('#datatable').DataTable();

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );
    </script>
@endsection
