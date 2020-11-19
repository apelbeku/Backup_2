@php

	$isEdit = isset($order);
	$action = $isEdit ? route('order.update', $order->id) : route('order.store');
	$put = $isEdit ? method_field('PUT') : null;

@endphp
<!DOCTYPE html>
<html>
<head>
	<title>Order Create</title>
	<!-- Select2 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
</head>
<body>
	<h1>Order Create</h1>

	<form x-data="bambang()" x-init="() => { initSelect() }" action="{{ $action }}" method="POST">
		@csrf
		{{ $put }}
		<label>
			Nama Pembeli
			<input type="text" name="customer_name" x-model="customer_name" />
		</label>

		<hr style="margin-bottom:12px;">

		<template x-for="(row, index) in rows" :key="row">
			<div>
				<label>
					Item
					<select class="select" :class=" 'row' + index " name="item_id[]" x-model="row.item_id" style="display:none;">
						<option value="">- choose item -</option>
						@foreach($items as $item)
						<option value="{{  $item->id }}">{{ $item->name }}</option>
						@endforeach
					</select>
				</label>
				&nbsp &nbsp &nbsp &nbsp

				<label>
					Jumlah
					<input type="number" name="qty[]" x-model="row.qty" x-on:change="setSubtotal(index)">
				</label>
				&nbsp &nbsp &nbsp

				<label>
					Harga
					<input type="number" name="price[]" x-model="row.price" readonly>
				</label>
				 &nbsp &nbsp &nbsp
				
				<label>
					Subtotal
					<input type="number" name="subtotal[]" x-model="row.subtotal" readonly>
				</label>
			</div>
		</template>
		<br><br>
		<button type="button" x-on:click="addRow">+ Tambah +</button>
		<button type="button" x-on:click="removeRow">- Hapus -</button>

		<hr>

		<label>
			Total
			<input type="number" name="total" x-model="total" readonly>
		</label>
		<button>TUMBAS NICKY</button>
	</form>

	<!-- Script -->
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
	<script type="text/javascript">
		function bambang()
		{
				const initialRow = 	{item_id: null, qty: 0, price: 0, subtotal: 0,};
				const items = @json($items);
			
			return {

				//  Data
				@if($isEdit)
					rows: @json($order->order_details),
					total: {{  $order->total }},
					customer_name: '{{ $order->customer_name }}',
				@else
					rows: [Object.assign({}, initialRow)],
					total: 0,
					customer_name: '',
				@endif



				// Method
				initSelect() {
					$('.select').select2();

					this.rows.forEach((row, index) => {
						$('.row' + index).on('select2:select', (e) => {
							row.item_id = e.target.value;
							this.setPrice(row.item_id, index);
						});
					});

				},

				addRow()
				{
					this.rows.push(Object.assign({}, initialRow) );
					this.$nextTick( () => { this.initSelect(); } );
				},

				removeRow()
				{
					this.rows.pop();

					this.setTotal();
				},

				setPrice(id, index) { 
					const item = items.find(item => item.id == id);
					const result = item && item.price;

					this.rows[index].price = result;

					this.setSubtotal(index);			
				},

				setSubtotal(index) {
					const row = this.rows[index];

					if (row.price && row.qty) {
						const result = row.price * row.qty;

						row.subtotal = result;
						this.setTotal();
					}
				},

				setTotal() {
					let result = 0;

					if (this.rows.length > 1) {
						result = this.rows.reduce((total, row) => (total + row.subtotal), 0);
					} else if (this.rows.length == 1) {
						result = this.rows[0].subtotal;
					}
					this.total = result;
				},
			}
		}
	</script>
</body>
</html>