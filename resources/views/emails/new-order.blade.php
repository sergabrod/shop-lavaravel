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
  <p>
    Haz <a href="{{ url('admin/orders/' . $cart->id) }}">click aquí</a>
    para más información sobre el pedido.
  </p>
<body>
</html>
