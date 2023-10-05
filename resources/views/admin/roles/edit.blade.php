@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Edit Role</h1>

<form action="{{ route('admin.roles.update', ['role' => $role->id]) }}"
	  method="POST">
	@method('PUT')
	@csrf
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Role</h6>
			<div class="float-right d-inline">
				<a href="{{ route('admin.roles.index') }}"
				   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
			</div>
		</div>
		<div class="card-body">
			{{-- Name --}}
			<div class="form-group">
				<label for="">Name *</label>
				<input type="text"
					   name="name"
					   placeholder="{{ $role->name }}"
					   class="form-control"
					   value="{{ old('name') }}"
					   autofocus>
			</div>
			{{-- Name End --}}
			{{-- Description --}}
			<div class="form-group">
				<label for="">Description *</label>
				<input type="text"
					   name="description"
					   placeholder="{{ $role->description }}"
					   class="form-control"
					   value="{{ old('description') }}"
					   autofocus>
			</div>
			{{-- Description End --}}
			{{-- Entities --}}
			<div class="form-group">
				<label for="">Entities</label>
				@foreach ($entities as $entity)
				<div class="p-2">
					{{-- Entity Title --}}
					<h6 class="text-capitalize"><b>{{ str_replace("_", " ", $entity) }}</b></h6>
					{{-- Entity Title End --}}
					@foreach ($CRUD as $item)
					@php
					$value = $entity . "." . $item;
					@endphp
					<label>
						<input type="checkbox"
							   id=""
							   name="entities[]"
							   value="{{ $value }}"
							   {{
							   in_array($value,
							   $role->entities) ? "checked" : "" }} />
						<span class="text-capitalize mr-2">{{ $item }}</span>
					</label>
					@endforeach
				</div>
				@endforeach
			</div>
			{{-- Entities End --}}
			<button type="submit"
					class="btn btn-success">Submit</button>
		</div>
	</div>
</form>

@endsection