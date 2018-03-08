@extends('layouts.shop')
@section('body-class', 'profile-page')
@section('title', 'Admin - Listado de Categorías')
@section('content')
    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Listado de categorías</h2>

                <div class="team">
                    <div class="row ">
                        <div class="text-center">
                            <a href="{{ url('admin/categories/create') }}" class="btn btn-primary btn-round">
                                <i class="material-icons">shop</i> Agregar Categoría
                            </a>
                        </div>
                            <table class="table">
                                <thead>

                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="col-md-2 text-center">Nombre</th>
                                    <th class="col-md-5 text-center">Descripción</th>
                                    <th>Imágen</th>
                                    <th class="text-center">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($categories as $category)
                                  <tr>
                                    <td class="text-center">{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                      <td>
                                          <img src="{{ $category->featured_image }}" height="50">
                                      </td>
                                    <td class="td-actions text-right">
                                      <form method="post" action="{{ url('/admin/categories/' . $category->id) }}">
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}
                                          <a type="button" rel="tooltip" title="Ver Categoría" class="btn btn-info btn-simple btn-xs">
                                              <i class="material-icons">shop</i>
                                          </a>
                                          <a href="{{ url('/admin/categories/' . $category->id . '/edit') }}" type="button" rel="tooltip" title="Editar Categoría" class="btn btn-success btn-simple btn-xs">
                                              <i class="fa fa-edit"></i>
                                          </a>
                                          <!-- lo anterior equivale a <input type="hidden" name="_method" value="DELETE"> -->
                                          <button type="submit" rel="tooltip" title="Eliminar Categoría" class="btn btn-danger btn-simple btn-xs">
                                              <i class="fa fa-times"></i>
                                          </button>
                                      </form>
                                    </td>
                                  </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="text-center">{{ $categories->links() }}</div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @include('includes.footer')


@endsection
