@extends('layouts.admin')
@section('content')
<div class="content" style="margin-left: 10px;">
    <h1>Creacion de un nuevo Ministerio</h1><br>
    <!-- MOSTRAR EN UNA LISTA LOS ERRORES -->
    @foreach($errors-> all() as $error) 
    <div class="alert alert-danger">
            <li>{{$error}}</li>
    </div>
        @endforeach

    <div class="row">
        <div class="col-md-11">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos</b></h3>
                </div>

                <div class="card-body" style="display: block;">
                    <form action="{{url('/ministerios ')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- DATOS DEL MINISTERIO -->
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Nombre del ministerio</label><b>*</b>
                                        <input type="text" name="nombre_ministerio" value="{{old('nombre_ministerio')}}" class="form-control" required>
                                        <!-- PARA MOSTRAR LOS ERRORES DE MANERA INDIVIDUAL -->
                                        <!-- @error('nombre_apellido')
                                            <small style="color: red"> * Este campo es requerido</small>
                                        @enderror -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Fecha de ingreso</label><b>*</b>
                                        <input type="date" name="fecha_ingreso" value="{{old('fecha_ingreso')}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descripción</label><b>*</b>
                                        <textarea class="form-control" name="descripcion" id="" cols="30" rows="10"></textarea>
                                        <!-- UTILIZANDO EL CKEDITOR -->
                                        <script>
                                            CKEDITOR.replace('descripcion')
                                        </script>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <a href="{{url('/ministerios')}}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar registro</button>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection