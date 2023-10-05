@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Edit Admin</h1>

<form action="{{ route('admin.staff.update', ['staff' => $admin->id]) }}"
	  method="POST">
	@method('PUT')
	@csrf
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 mt-2 font-weight-bold text-primary">Edit Admin</h6>
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
					   placeholder="{{ $admin->name }}"
					   class="form-control"
					   value="{{ old('name') }}"
					   autofocus>
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email"
					   name="email"
					   placeholder="{{ $admin->email }}"
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
								   value="{{ $role->id }}"
								   {{in_array($role->name, $admin->roleNames()) ? "checked" : "" }} />
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