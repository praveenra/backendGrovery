@extends('layouts.web')
@section('title','Grovery') 
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<div class="category">
    <section class="container">
            <table class="table">
            	<thead>
            		<tr>
            			<th>Category</th>
            			<th>Product</th>
            			<th></th>
            			<th>Action</th>
            		</tr>
            	</thead>
            	<tbody>
            		@foreach($add_list as $add)
            			<tr>
            				<td>{{$add->category}}</td>
            				<td>{{$add->product}} </td>
            				<td><img src="{{asset('admin/images/products')}}/{{$add->img}}" height="80" width="120"></td>
            				<td><a class="btn btn-info" href="{{asset('addcart')}}/{{$add->store_id}}/{{$add->product_id}}">Add to cart</a></td>
            			</tr>
            		@endforeach
            	</tbody>
            </table>
    </section>
</div>
@endsection