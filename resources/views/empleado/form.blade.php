<h1> {{$accion}} empleado</h1>

@if (count($errors) > 0)

    <div class="alert alert-danger" role="alert">

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="form-group">
        
        <label for="Nombre">Nombre</label>
        <input type="text" class="form-control" 
        name="Nombre" value="{{isset($empleado->Nombre) ? $empleado->Nombre: old('Nombre')}}" id="Nombre" >
        
</div>
        <label for="ApellidoPaterno">Apellido Paterno</label>
        <input type="text" class="form-control" 
        name="ApellidoPaterno" value="{{isset($empleado->ApellidoPaterno) ? $empleado->ApellidoPaterno:old('ApellidoPaterno')}}" id="ApellidoPaterno">

<div class="form-group"> 
        <label for="ApellidoMaterno">Apellido Materno</label>
       <input type="text" class="form-control" name="ApellidoMaterno" 
       value="{{isset($empleado->ApellidoMaterno) ? $empleado->ApellidoMaterno:old('ApellidoMaterno')}}" id="ApellidoMaterno">
      
</div>
<div class="form-group">
       <label for="Correo">Correo</label>
       <input type="text" class="form-control" name="Correo" 
       value="{{isset($empleado->Correo) ? $empleado->Correo:old('Correo')}}"id="Correo">
       
</div>

<div class="form-group">

       <label for="Foto">Foto</label>
       @if (isset($empleado->Foto))
       <img src="{{asset ('storage').'/'.$empleado->foto}}" whidt="100"alt=""> 
       @endisset
       <input type="file" name="Foto" class="form-control" value="" id="Foto" >
</div>
<br>
       <input class="btn btn-success" type="submit" value="{{ $accion }} empleado">
<br>
<br>
       <a class="btn btn-primary" href="{{ url('empleado')}}">Regresar a empleados</a>
 </form>