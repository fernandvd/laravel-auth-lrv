@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
        <form action="{{route('categories.store')}}" method="post">
            @csrf
            <div class="mb-3 col">
                @error('name')
                <div class="alert alert-danger">{{$message}}</div>
                @enderror 

                @error('color')
                <div class="alert alert-danger">
                    {{message}}
                </div>
                @enderror

                @if (session('success'))
                    <h6 class="alert alert-success">
                        {{session('success')}}
                    </h6>
                @endif
                <label for="exampleFormControlInput1" class="form-label">
                    Nombre de la categoria
                </label>
                <input type="text" name="name"  class="form-control mb-2" id="exampleFormControlInput1" placeholder="hogar">

                <label for="exampleColorInput" class="form-label">
                    Escoge el color de la categoria
                </label>
                <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="#5632323" title="Choose your color">

                <input type="submit" value="Crear tarea" class="btn btn-primary my-2">
            </div>
        </form>

        <div>
            @foreach ($categories as $category)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('categories.show', ['category' => $category->id])}}" class="d-flex align-items-center gap-2">
                            <span class="color-container" style="background-color: {{$category->color }}"></span> {{$category->name}}
                        </a>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$category->id}}">Eliminar</button>
                    </div>
                </div>

                <!--Modal -->
                <div class="modal fade" id="modal{{$category->id}}" tabindex="-1" aria-labelledby="exampleMoalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-head">
                                <h5 class="modal-title">
                                    ELIMINAR CATEGORIA
                                </h5>
                                <button type="button" data-bs-dismiss="modal" 
                                aria-label="Close" class="btn-close"></button>
                            </div>
                            <div class="modal-body">
                                Al elimar la categoria 
                                <strong>{{$category->name }}</strong> se eliminara todas las tareas asignadas de la misma.
                                Esta seguro de elimarlo ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, ccancelar</button>
                                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf 
                                    <button type="submit" class="btn btn-primary">Si</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection