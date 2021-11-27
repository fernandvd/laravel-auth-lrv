@extends('app')

@section('content')

<div class="container w-35 border p-4">
    <div class="row mx-auto">
        <form action="{{route('todos.update', ['todo' => $todo->id])}}" method="post">
            @method('PATCH')
            @csrf 
            <div class="mb-3 col">
                @error('title')
                <div class="alert alert-danger">
                    {{$message}}
                </div>
                @enderror

                @if (session('success'))
                    <h6 class="alert alert-success">
                        {{session('success')}}
                    </h6>
                @endif 
                <label for="title" class="form-label">
                    Titulo de la tarea 
                </label>
                <input type="text" name="titulo" id="title" class="form-control mb-2" placeholder="Comprar la cena" value="{{ $todo->title}}">

                <label for="category_id" class="form-label">
                    Categoria de la tarea 
                </label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name }}
                        </option>
                    @endforeach
                </select>

                <input type="submit" value="Actualizar tarea" class="btn btn-primary my-2">
            </div>
        </form>
    </div>
</div>
@endsection