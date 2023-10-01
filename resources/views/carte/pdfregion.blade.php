<!DOCTYPE html>
<html>
<head>
    <title>Votre PDF</title>
    <link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="row">
        <div class="col-md-12 text-center">
            REPUBLIQUE DU SENEGAL
        </div>
        <div class="col-md-12 text-center">
            LISTE D’ELECTEURS POUR LE PARRAINAGE AUX ELECTIONS Présidentielle du
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            NOM DE LA LISTE DE CANDIDATS
        </div>
        <div class="col-md-5">
            REGION de
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            COMMUNE D’INSCRIPTION DES PARRAINS
        </div>
        <div class="col-md-6">
            REGION de
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table  class="table table-striped table-bordered w-100">
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
                    @foreach ($cartesParRegions as $cartesParRegion)
                        <tr>
                            <td>{{ $cartesParRegion->id  }}</td>
                            <td>{{ $cartesParRegion->prenom  }}</td>
                            <td>{{ $cartesParRegion->nom  }}</td>
                            <td>{{ $cartesParRegion->numelec  }}</td>
                            <td>{{ $cartesParRegion->numcni  }}</td>
                            <td>{{ date('d-m-Y', strtotime( $cartesParRegion->expiration)) }}</td>
{{--                              <td><img src="http://127.0.0.1/backendparrainnage/storage/app/public/signatures/{{ $cartesParRegion->liensignature }}" style="height: 30px;"></td>
  --}}
                                  <td><img src="{{ asset('upload/'. $cartesParRegion->liensignature) }}" style="height: 30px;"></td>

</tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{asset('js/bootstrap.min.js') }}"></script>
    <script src="{{asset('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        window.print()    });
</script>
</body>
</html>
