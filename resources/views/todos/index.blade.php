@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row-mx-auto">
        <form action="{{ route('todos.store') }}" method="post">
            @csrf 
            <div class="mb-3 col">
                @error('title')
                <div class="alert alert-danger">
                    {{message}}
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
                <input type="text" name="title" id="title" placeholder="Comprar cena" class="form-control mb-2">

                <label for="category_id" class="form-label">
                    Categoria de la tarea 
                </label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach ($categories as $category )
                        <option value="{{ $category->id}}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <input type="submit" value="Crear tarea" class="btn btn-primary my-2">
            </div>
        </form>

        <div>
            @foreach ($todos as $todo)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <a href="{{ route('todos.show', ['todo' => $todo->id ]) }}"> {{ $todo->title }}</a>
                    </div>

                    <div class="col-md-3 d-flex justify-content-end">
                        <form action="{{ route('todos.destroy', [$todo->id]) }}" method="post">
                            @method('DELETE')
                            @csrf 
                            <button class="btn btn-danger btn-sm">Eliminar </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection