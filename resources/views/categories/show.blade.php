@extends('app')

@section('content')

<div class="container w-35 border p-4">
    <div class="row mx-auto">
        <form action="{{route('categories.update', ['category' => $category->id])}}" method="post">
            @method('PATCH')
            @csrf 
            <div class="mb-3 col">
                @error('name')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror

                @error('color')
                <div class="alert alert-danger">
                    {{$message}}
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
                <input type="text" name="name" id="exampleFormControlInput1" class="form-control mb-2" placeholder="Hogar" value="{{ $category->name}}">

                <label for="exampleColorInput" class="form-label">
                    Esscoge un color para la ccategoria
                </label>
                <input type="color" name="color" id="exampleColorInput" class="form-control form-control-color" placeholder="Hogar" value="{{ $category->color}}" title="Choose yoour color">

                <input type="submit" value="Actualizar categoria" class="btn btn-primary my-2">
            </div>
        </form>

        <div>
            @if($category->todos->count() > 0)
                @foreach($category->todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('todos.edit', ['todo' => $todo->id])}}"> {{$todo->title }}</a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('todos.destroy', [$todo->id])}}" method="post">
                            @method('DELETE')
                            @csrf 
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                </div>
                @endforeach 
            @else 
                <div>
                    No hay tareas 
                </div>
            @endif 
        </div>
    </div>
</div>
@endsection