@extends('layouts.shop')
@section('body-class', 'profile-page')
@section('title', 'Bienvenidos a Laravel Shop')
@section('content')
    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Editar Producto</h2>
                @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <form method="post" action="{{ url('/admin/products/' . $product->id . '/edit') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Nombre</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Precio</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Descripción corta</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description', $product->description) }}">
                    </div>
                    <div class="form-group label-floating">
                        <textarea class="form-control" name="long_description" placeholder="Descripción extendida" rows="5">
                          {{ old('long_description', $product->long_description) }}
                        </textarea>
                    </div>
                    <button class="btn btn-primary">Actualizar Producto</button>
                    <a href="{{ url('admin/products') }}" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>

    </div>

    @include('includes.footer')


@endsection
