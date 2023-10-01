{{-- \resources\views\permissions\create.blade.php --}}
@extends('welcome')

@section('title', '| Enregister carte')
@section("css")

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>

    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
<style>
    .kbw-signature { width: 100%; height: 200px;}
    #sig canvas{
        width: 100% !important;
        height: auto;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">

                        <ol class="breadcrumb hide-phone p-0 m-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" >ACCUEIL</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('carte.index') }}" >LISTE D'ENREGISTREMENT DES cartes</a></li>

                        </ol>
                    </div>
                    <h4 class="page-title">ENREGISTER PARRAIN</h4>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('carte.store') }}" method="POST">
            @csrf
             <div class="card">
                        <div class="card-header  text-center">FORMULAIRE D'ENREGISTREMENT D'UN carte</div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Prenom</label>
                                        <input type="text" name="prenom"  value="{{ old('prenom') }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>nom</label>
                                        <input type="text" name="nom"  value="{{ old('nom') }}" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Numero Electeur</label>
                                        <input type="number" name="numelec"  value="{{ old('numelec') }}"  minlength="9" maxlength="9" data-parsley-type="number"	 class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Numéro carte d'idantité</label>
                                        <input type="number" name="numcni"  value="{{ old('numcni') }}"  minlength="13" maxlength="13" data-parsley-type="number"class="form-control" min="1" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Date Expiration</label>
                                        <input type="date" name="expiration"  value="{{ old('expiration') }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Collecteur</label>
                                    <select class="form-control" name="collecteur_id" id="collecteur_id" required="">
                                        <option value="">Selectionner</option>
                                        @foreach ($collecteurs as $collecteur)
                                        <option value="{{$collecteur->id}}">{{$collecteur->nom}}</option>
                                            @endforeach

                                    </select>
                                </div>

                                    <div class="col-lg-6">
                                        <label>Region</label>
                                        <select class="form-control" name="region_id" id="region_id" required="">
                                            <option value="">Selectionner</option>
                                            @foreach ($regions as $region)
                                            <option value="{{$region->id}}">{{$region->nom}}</option>
                                                @endforeach

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Departement</label>
                                        <select class="form-control" name="departement_id" id="departement_id" required="">
                                           {{--   @foreach ($departements as $departement)
                                            <option value="{{$departement->id}}">{{$departement->nom}}</option>
                                                @endforeach  --}}

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Commune</label>
                                        <select class="form-control" name="commune_id" id="commune_id" required="">
                                           {{--   @foreach ($communes as $commune)
                                            <option value="{{$commune->id}}">{{$commune->nom}}</option>
                                                @endforeach  --}}

                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="col-md-12">
                                            <label class="" for="">Signature:</label>
                                            <br/>
                                            <div id="sig" ></div>
                                            <br/>
                                            <button id="clear" class="btn btn-danger btn-sm">Clear Signature</button>
                                            <textarea id="signature64" name="signed" style="display: none"></textarea>
                                        </div>
                                    </div>
                                <div>
                                    <center>
                                        <button type="submit" class="btn btn-success btn btn-lg "> ENREGISTRER</button>
                                    </center>
                                </div>
                            </div>

                            </div>

            </form>

@endsection

@section("script")
<script>
    $("#region_id").change(function () {
        var region_id =  $("#region_id").children("option:selected").val();
          var departement_id = "<option value=''>Veuillez selectionner</option>";

          $.ajax({
              type:'GET',
              url:'/debartement/by/region/'+region_id,
              data:'_token = <?php echo csrf_token() ?>',
              success:function(data) {
                  $.each(data,function(index,row){
                      departement_id +="<option value="+row.id+">"+row.nom+"</option>";
                  });
                  $("#departement_id").empty();
                  $("#departement_id").append(departement_id);
              }
          });
        });
        $("#departement_id").change(function () {
            var departement_id =  $("#departement_id").children("option:selected").val();
              var commune_id = "<option value=''>Veuillez selectionner</option>";

              $.ajax({
                  type:'GET',
                  url:'/commune/by/departement/'+departement_id,
                  data:'_token = <?php echo csrf_token() ?>',
                  success:function(data) {
                      $.each(data,function(index,row){
                          commune_id +="<option value="+row.id+">"+row.nom+"</option>";
                      });
                      $("#commune_id").empty();
                      $("#commune_id").append(commune_id);
                  }
              });
            });
  {{--    $("#commune_id").change(function () {
    var commune_id =  $("#commune_id").children("option:selected").val();
      var departement_id = "<option value=''>Veuillez selectionner</option>";

      $.ajax({
          type:'GET',
          url:'/commune/departement/'+commune_id,
          data:'_token = <?php echo csrf_token() ?>',
          success:function(data) {
              $.each(data,function(index,row){
                  departement_id +="<option value="+row.id+">"+row.nomd+"</option>";
              });
              $("#departement_id").empty();
              $("#departement_id").append(departement_id);
          }
      });
    });
  --}}
  var sig = $('#sig').signature({syncField: '#signature64', syncFormat: 'PNG'});
  $('#clear').click(function(e) {
      e.preventDefault();
      sig.signature('clear');
      $("#signature64").val('');
  });
    </script>
        <script src="{{ asset('plugins/parsleyjs/fr.js') }}"></script>

    <script src="{{ asset('plugins/parsleyjs/parsley.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();


        });
        window.Parsley.setLocale("fr")
    </script>

@endsection
