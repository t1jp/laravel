<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.1.slim.js" integrity="sha256-tXm+sa1uzsbFnbXt8GJqsgi2Tw+m4BLGDof6eUPjbtk=" crossorigin="anonymous"></script>
<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>CRUD Estudiantes</title>
</head>
<body>
<div class="container mt-3">
  <h2>Estudiantes</h2>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
    Nuevo
  </button>

  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Datos Estudiantes</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container">
                <form class="d-flex" action="{{route('CRUD.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="col">

                    <div class="mb-3">
                            <label for="txt_id" class="form-label">Id</label>
                            <input type="text" name="txt_id" id="txt_id" class="form-control" placeholder="0" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="txt_carne" class="form-label">Codigo</label>
                            <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="E001" onchange="carnetValidacion(this);" required/>
                            @error('txt_carne')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_nombres" class="form-label">Nombres</label>
                            <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Luis Jose" required/>
                            @error('txt_nombres')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_apellidos" class="form-label">Apellidos</label>
                            <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Mendez Orduz" required/>
                            @error('txt_apellidos')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_direccion" class="form-label">Direccion</label>
                            <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="5ta calle oriente" required/>
                            @error('txt_direccion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_telefono" class="form-label">Telefono</label>
                            <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="00000000" required/>
                            @error('txt_telefono')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="txt_correo" class="form-label">correo</label>
                            <input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="x@mail.com" required/>
                            @error('txt_correo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                          <label for="lbl_sangre" class="form-label">Tipo Sangre</label>
                          <select class="form-select" name="drop_sangre" id="drop_sangre">
                            <option value=0 selected>-----sangre-----</option>
                            @foreach ($blood as $sangre)
                                <option value="{{$sangre->id}}">{{$sangre->sangre}}</option>
                            @endforeach

                          </select>
                        </div>

                        <div class="mb-3">
                            <label for="txt_fn" class="form-label">fecha de nacimiento</label>
                            <input type="date" name="txt_fn" id="txt_fn" class="form-control" required/>
                            @error('txt_fn')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <input type="submit" name="btn_agregar" id="btn_agregar" class="btn btn-primary" value="agregar" required>

                        </div>

                    </div>
                </form>
                        </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      <p>{{ $message }}</p>
  </div>
  @endif
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Carne</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Direccion</th>
        <th>Telefono</th>
        <th>Correo Electronico</th>
        <th>Tipo Sangre</th>
        <th>Fecha Nacimiento</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="tbl_estudiantes">
      @foreach ($student as $item)
      <!-- The Modal -->
<div class="modal" id="myModal1{{$item->id}}">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Editar</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container">
                <form class="d-flex" action="{{route('CRUD.update',$item->id)}}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="col">

                    <div class="mb-3">
                            <label for="txt_id" class="form-label">Id</label>
                            <input type="text" name="txt_id" id="txt_id" class="form-control" placeholder="0" value="{{$item->id}}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="txt_carne" class="form-label">Codigo</label>
                            <input type="text" name="txt_carne" id="txt_carne" class="form-control" placeholder="E001" value="{{$item->carne}}" onchange="carnetValidacion(this);" required/>
                            @error('txt_carne')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_nombres" class="form-label">Nombres</label>
                            <input type="text" name="txt_nombres" id="txt_nombres" class="form-control" placeholder="Luis Jose" value="{{$item->nombres}}" required/>
                            @error('txt_nombres')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_apellidos" class="form-label">Apellidos</label>
                            <input type="text" name="txt_apellidos" id="txt_apellidos" class="form-control" placeholder="Mendez Orduz" value="{{$item->apellidos}}" required/>
                            @error('txt_apellidos')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_direccion" class="form-label">Direccion</label>
                            <input type="text" name="txt_direccion" id="txt_direccion" class="form-control" placeholder="5ta calle oriente" value="{{$item->direccion}}" required/>
                            @error('txt_direccion')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="txt_telefono" class="form-label">Telefono</label>
                            <input type="number" name="txt_telefono" id="txt_telefono" class="form-control" placeholder="00000000" value="{{$item->telefono}}" required/>
                            @error('txt_telefono')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="txt_correo" class="form-label">correo</label>
                            <input type="text" name="txt_correo" id="txt_correo" class="form-control" placeholder="x@mail.com" value="{{$item->correo_electronico}}" required/>
                            @error('txt_correo')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                          <label for="lbl_sangre" class="form-label">Tipo Sangre</label>
                          <select class="form-select" name="drop_sangre" id="drop_sangre">
                            <option value="0">-----sangre-----</option>
                            @foreach ($blood as $sangre)
                            @if($item->id_tipos_sangre==$sangre->id)
                                <option value="{{$sangre->id}}" selected>{{$sangre->sangre}}</option>
                            @else
                            <option value="{{$sangre->id}}" >{{$sangre->sangre}}</option>
                            @endif
                            @endforeach

                          </select>
                        </div>

                        <div class="mb-3">
                            <label for="txt_fn" class="form-label">fecha de nacimiento</label>
                            <input type="date" name="txt_fn" id="txt_fn" value="{{$item->fecha_nacimiento}}" class="form-control" required/>
                            @error('txt_fn')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">

                            <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar" requiredd>

                        </div>

                    </div>
                </form>
                        </div>
        </div>



      </div>
    </div>
  </div>
      <tr data-id_estudiante="{{$item->id}}" data-id_sangre="{{$item->id_tipos_sangre}}">
        <td>{{$item->carne}}</td>
        <td>{{$item->nombres}}</td>
        <td>{{$item->apellidos}}</td>
        <td>{{$item->direccion}}</td>
        <td>{{$item->telefono}}</td>
        <td>{{$item->correo_electronico}}</td>
        <td>{{$item->sangre}}</td>
        <td>{{$item->fecha_nacimiento}}</td>
        <td>
          <button class="btn btn-warning btn-sm btn-editar"  data-bs-toggle="modal" data-bs-target="#myModal1{{$item->id}}">Editar</button>
          <button class="btn btn-danger btn-sm btn-eliminar"  data-bs-toggle="modal" data-bs-target="#myModal2{{$item->id}}">Eliminar</button>
        </tr>
        <!-- The Modal -->
<div class="modal" id="myModal2{{$item->id}}">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Eliminar</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          Seguro que desea eliminar el estudiantes {{$item->nombres}} {{$item->apellidos}}?
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <form action="{{route('CRUD.destroy',$item->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="submit" class="btn btn-danger" value="Eliminar">
                </form>
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
        @endforeach
    </tbody>
  </table>
</div>
<script type="text/javascript">
    function limpiarForms(){
      $('#txt_id').val(0);
      $("#drop_sangre").val(0);
      $("#txt_carne").val("");
      $("#txt_nombres").val("");
      $("#txt_apellidos").val("");
      $("#txt_direccion").val("");
      $("#txt_telefono").val("");
      $("#txt_correo").val("");
      $("#txt_fn").val("");
    }
    function carnetValidacion(text) {
      const pattern = /(^E{1})([0-9]{3})$/;
      if (!pattern.test(text.value)) {
        text.setCustomValidity
          ('Ingrese un carnet Valido: E001-E999');
      }else {
        text.setCustomValidity('');
    }
    return true;
    }
</script>

</body>
</html>
