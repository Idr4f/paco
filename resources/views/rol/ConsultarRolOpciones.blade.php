@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar opciones de rol</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <form action="{{ url('opciones-rol') }}" role="search">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Ingresar nombre del rol</label>
                <div class="col-md-12">
                    <input class="form-control ui-autocomplete-input" id="nom_rol" name="nom_rol" type="text" placeholder="Ingresar el nombre del rol" required autofocus>
                </div>
              </div>
            </div>

            <br>
            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Consultar
                    </button>
                </div>
            </div>
          </form>

        </div>
    </div>
</div>
<script>
 $(document).ready(function() {
    $( "#nom_rol" ).autocomplete({
        messages : {
      noResults : 'No hay resultados.',
      results : function(count) {
        return count + (count > 1 ? ' results' : ' result ') + ' found';
      }
    },
        source: function(request, response) {
            $.ajax({
            url: "{{ route('autocompleterol') }}",
            data: {
                    term : request.term                
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                
                    return obj.nom_rol;
                    
               }); 
                response(resp);
               
            }
        });
    },
    minLength: 2
 });
});
 
</script>  
@endsection
