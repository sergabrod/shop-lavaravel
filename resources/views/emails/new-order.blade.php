<!DOCTYPE html>
<html>
<head>
  <title>Nuevo pedido</title>
</head>
<body>
  <p>Se ha realizado un nuevo pedido!</p>
  <p>Datos del pedido:</p>
  <ul>
    <li>
      <strong>Nombre:</strong>
      {{ $user->name }}
    </li>
    <li>
      <strong>email:</strong>
      {{ $user->email }}
    </li>
    <li>
      <strong>Fecha:</strong>
      {{ $cart->order_date }}
    </li>
  </ul>
  <hr>
    <p>Detalle del pedido</p>
    <ul>
      @foreach ($cart->details as $detail)
        <li>
          {{ $detail->product->name }} x {{ $detail->quantity }} - ${{ $detail->product->price}}
          (Subtotal: ${{ $detail->product->price * $detail->quantity }})
        </li>
      @endforeach
    </ul>
    <p><strong>Total a pagar:</strong> ${{ $cart->total }}
  <hr>
  <p>
    Haz <a href="{{ url('admin/orders/' . $cart->id) }}">click aquí</a>
    para más información sobre el pedido.
  </p>
<body>
</html>
