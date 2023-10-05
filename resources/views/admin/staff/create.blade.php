@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Add Admin</h1>

<form action="{{ route('admin.staff.store') }}"
	  method="post"
	  enctype="multipart/form-data">
	@csrf
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 mt-2 font-weight-bold text-primary">Add Admin</h6>
			<div class="float-right d-inline">
				<a href="{{ route('admin.staff.index') }}"
				   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
			</div>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label for="">Name *</label>
				<input type="text"
					   name="name"
					   placeholder="John Doe"
					   class="form-control"
					   value="{{ old('name') }}"
					   autofocus>
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email"
					   name="email"
					   placeholder="johndoe@gmail.com"
					   class="form-control"
					   value="{{ old('email') }}">
			</div>
			<div class="form-group">
				<label for="">Roles</label>
				<div class="d-flex flex-wrap">
					@foreach ($roles as $role)
					<div class="p-2">
						<label>
							<input type="checkbox"
								   id=""
								   name="roles[]"
								   value="{{ $role->id }}" />
							<span class="text-capitalize">{{ $role->name }}</span>
						</label>
					</div>
					@endforeach
				</div>
			</div>
			<button type="submit"
					class="btn btn-success">Submit</button>
		</div>
	</div>
</form>

@endsection