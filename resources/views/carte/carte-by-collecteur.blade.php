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
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Gestion de Parrainnage</a></li>
                    <li class="breadcrumb-item active">Carte Par Collecteur</li>
                </ol>
            </div>
            <h4 class="page-title">{{ $nom }}</h4>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="row">

    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered w-100">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                        <th>N° de la carte d'électeur</th>
                        <th>Numéro d'Identification National</th>
                        <th>Date Expiration</th>
                        <th>Signature</th>
                    </tr>
                    </thead>


                    <tbody>
                        @foreach ($cartesParCollecteurs as $cartesParCollecteur)
                            <tr>
                                <td>{{ $cartesParCollecteur->id  }}</td>
                                <td>{{ $cartesParCollecteur->prenom  }}</td>
                                <td>{{ $cartesParCollecteur->nom  }}</td>
                                <td>{{ $cartesParCollecteur->numelec  }}</td>
                                <td>{{ $cartesParCollecteur->numcni  }}</td>
                                <td>{{ date('d-m-Y', strtotime( $cartesParCollecteur->expiration)) }}</td>
                                <td><img src="http://127.0.0.1/backendparrainnage/storage/app/public/signatures/{{ $cartesParCollecteur->liensignature }}" style="height: 30px;"></td>
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

            //Buttons examples
            var table = $('#datatable-buttons').DataTable({
                lengthChange: false,
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        } );
        $('button').on('click', function(e) {
            window.open('data:application/vnd.ms-excel,' + encodeURIComponent( document.getElementById('datatable-buttons').outerHTML));
          })
    </script>
@endsection
