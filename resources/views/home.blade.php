@extends('layouts.shop')
@section('body-class', 'profile-page')
@section('title', 'Laravel Shop | Dashboard ')
@section('content')
    <div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">

    </div>

    <div class="main main-raised">
        <div class="container">
            <div class="section">
                <h2 class="title text-center">Dashboard</h2>

                @if (session('notification'))
                    <div class="alert alert-success">
                        {{ session('notification') }}
                    </div>
                @endif

                <ul class="nav nav-pills nav-pills-primary" role="tablist">
                	<li class="active">
                		<a href="#dashboard" role="tab" data-toggle="tab">
                			<i class="material-icons">dashboard</i>
                			Carrito de compras
                		</a>
                	</li>

                	<li>
                		<a href="#tasks" role="tab" data-toggle="tab">
                			<i class="material-icons">list</i>
                			Pedidos realizados
                		</a>
                	</li>
                </ul>

                <hr>
                <p>Tu carrito de compras posee {{ auth()->user()->cart->details->count() }} productos</p>
                <hr>
                  <table class="table">
                      <thead>

                      <tr>
                          <th class="text-center">#</th>
                            <th class="text-center">Producto</th>
                          <th>Precio</th>
                          <th>Desc.</th>
                          <th>Cantidad</th>
                          <th>Subtotal</th>
                          <th class="text-center" >Opciones</th>
                      </tr>
                      </thead>
                      <tbody>

                        @php
                          $total = 0;
                        @endphp

                      @foreach (auth()->user()->cart->details as $cartDetail)
                          <tr>
                          <td class="text-center">
                            <img src="{{ $cartDetail->product->featured_image }}" height="50">
                          </td>
                          <td>{{ $cartDetail->product->name }}</td>
                          <td>&dollar; {{ $cartDetail->product->price }}</td>
                          <td>{{ $cartDetail->discount }}</td>
                          <td>{{ $cartDetail->quantity }}</td>
                          @php
                              $subtotal = 0;
                              $subtotal = $cartDetail->quantity * $cartDetail->product->price;
                              $total = $total + $subtotal;
                          @endphp
                          <td>&dollar; {{ $subtotal }}</td>
                          <td class="td-actions">
                            <form method="post" action="{{ url('/cart/detail/delete') }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <a href="{{ url('products/' . $cartDetail->product->id . '/show' ) }}" target="_blank" rel="tooltip"
                                  title="Ver Producto" class="btn btn-info btn-simple btn-xs">
                                    <i class="material-icons">shop</i>
                                </a>
                                <input type="hidden" name="cart_detail_id" value="{{ $cartDetail->id }}">
                                <button type="submit" rel="tooltip" title="Eliminar Producto" class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                          </td>
                      </tr>
                      @endforeach
                      <tr>
                        <td colspan="5" class="text-right"><span class="label label-primary">Total</span></td>
                        <td>&dollar; {{ $total }}</td>
                        <td></td>
                      </tr>
                      </tbody>
                  </table>
                  <div class="text-center">
                    <form action="{{ url('/order')}}" method="post">
                      {{ csrf_field()}}
                      <button class="btn btn-primary btn-round">
                      	<i class="material-icons">shop</i> Realizar Pedido
                      </button>
                    </form>
                  </div>
            </div>
        </div>

    </div>

    @include('includes.footer')

@endsection
