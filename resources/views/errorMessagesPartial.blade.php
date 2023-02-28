@if ($errors->any())
<div class="alert alert-danger" role="alert">
    <p>Se han producido los siguientes errores:</p>
    <ul>
    @foreach($errors->all() as $error)
    
        <li>{{ $error }}</li>
            
    @endforeach
    </ul>
</div>
@endif