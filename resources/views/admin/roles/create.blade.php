@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Add Role</h1>

<form action="{{ route('admin.roles.store') }}"
	  method="post"
	  enctype="multipart/form-data">
	@csrf
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 mt-2 font-weight-bold text-primary">Add Role</h6>
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
					   placeholder="Role"
					   class="form-control"
					   value="{{ old('name') }}"
					   required
					   autofocus>
			</div>
			{{-- Name End --}}
			{{-- Description --}}
			<div class="form-group">
				<label for="">Description *</label>
				<input type="text"
					   name="description"
					   placeholder="Add a description"
					   class="form-control"
					   value="{{ old('description') }}"
					   autofocus>
			</div>
			{{-- Description End --}}
			{{-- Entities --}}
			<div class="form-group">
				<label for="">Entities</label>
				<div class="d-flex justify-content-between flex-wrap">
					@foreach ($entities as $entity)
					<div class="border-bottom m-1 p-2">
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
								   value="{{ $value }}" />
							<span class="text-capitalize mr-2">{{ $item }}</span>
						</label>
						@endforeach
					</div>
					@endforeach
				</div>
			</div>
			{{-- Entities End --}}
			<button type="submit"
					class="btn btn-success">Submit</button>
		</div>
	</div>
</form>

@endsection