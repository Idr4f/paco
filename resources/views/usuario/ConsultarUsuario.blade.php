@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Consultar datos de usuario</h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <form action="{{ url('datos-usuario') }}" role="search">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>Ingresar email del usuario</label>
                <div class="col-md-12">
                    <input class="form-control ui-autocomplete-input" id="email" name="email" type="text" placeholder="Ingresar el email del usuario" required autofocus>
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
    $( "#email" ).autocomplete({
        messages : {
      noResults : 'No hay resultados.',
      results : function(count) {
        return count + (count > 1 ? ' results' : ' result ') + ' found';
      }
    },
        source: function(request, response) {
            $.ajax({
            url: "{{ route('autocompleteusuario') }}",
            data: {
                    term : request.term                
             },
            dataType: "json",
            success: function(data){
               var resp = $.map(data,function(obj){
                
                    return obj.email;
                    
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
