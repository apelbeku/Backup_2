<!DOCTYPE html>
<html>
<head>
	<title>Order</title>
</head>
<body>
	<h1>Order List</h1>

	<a href="{{ route('order.create') }}" style="margin-bottom:5px;">Tumbas</a>

	<table border="1" width="100%">
		<thead>
			<tr>
				<th>Nama Pembeli</th>
				<th>Total</th>
				<th>Tanggal Transaksi</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
				@foreach($orders as $order)
			<tr>
				<td>{{ $order->customer_name }}</td>
				<td>{{ $order->total }}</td>
				<td>{{ $order->created_at }}</td>
				<td>
					<a href="{{ route('order.edit', $order->id) }}">Edit</a>
					<form method="POST" action="{{ route('order.destroy', $order->id) }}">
							@csrf @method('delete')
						<button>Delete</button>
					</form>
				</td>
			</tr>
				@endforeach
		</tbody>
	</table>
</body>
</html>