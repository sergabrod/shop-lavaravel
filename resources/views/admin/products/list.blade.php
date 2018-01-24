@extends('layouts.shop')
@section('body-class', 'profile-page')
@section('title', 'Admin - Listado de productos')
@section('content')
    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Listado de productos</h2>

                <div class="team">
                    <div class="row ">
                        <div class="text-center">
                            <a href="{{ url('admin/products/create') }}" class="btn btn-primary btn-round">
                                <i class="material-icons">shop</i> Agregar Producto
                            </a>
                        </div>
                            <table class="table">
                                <thead>

                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="col-md-2 text-center">Nombre</th>
                                    <th class="col-md-5 text-center">Descripción</th>
                                    <th class="text-center">Categoría</th>
                                    <th class="text-right">Precio</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->category ? $product->category->name : 'Sin Categoría' }}</td>
                                    <td class="text-right">&dollar; {{ $product->price }}</td>
                                    <td class="td-actions text-right">
                                      <form method="post" action="{{ url('/admin/products/' . $product->id) }}">
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}
                                          <a type="button" rel="tooltip" title="Ver Producto" class="btn btn-info btn-simple btn-xs">
                                              <i class="material-icons">shop</i>
                                          </a>
                                          <a href="{{ url('/admin/products/' . $product->id . '/edit') }}" type="button" rel="tooltip" title="Editar Producto" class="btn btn-success btn-simple btn-xs">
                                              <i class="fa fa-edit"></i>
                                          </a>
                                          <a href="{{ url('/admin/products/' . $product->id . '/images') }}" rel="tooltip" title="Imágenes del producto" class="btn btn-warning btn-simple btn-xs">
                                              <i class="material-icons">image</i>
                                          </a>
                                          <!-- lo anterior equivale a <input type="hidden" name="_method" value="DELETE"> -->
                                          <button type="submit" rel="tooltip" title="Eliminar Producto" class="btn btn-danger btn-simple btn-xs">
                                              <i class="fa fa-times"></i>
                                          </button>
                                      </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">{{ $products->links() }}</div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('includes.footer')


@endsection
