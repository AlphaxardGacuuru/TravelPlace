@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Role</h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 mt-2 font-weight-bold text-primary">View Role</h6>
		<div class="float-right d-inline">
			<a href="{{ route('admin.roles.create') }}"
			   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered"
				   id="dataTable"
				   width="100%"
				   cellspacing="0">
				<thead>
					<tr>
						<th>SL</th>
						<th>Name</th>
						<th>Description</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($roles as $role)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $role->name }}</td>
						<td>{{ $role->description }}</td>
						<td>
							<div class="d-flex">
								{{-- Edit Link --}}
								<div class="p-1">
									<a href="{{ route('admin.roles.edit', ['role' => $role->id]) }}"
									   class="btn btn-warning btn-sm">
										<i class="fas fa-edit"></i>
									</a>
								</div>
								{{-- Edit Link End --}}
								{{-- Delete Link --}}
								<div class="p-1">
									<a href="#"
									   class="btn btn-danger btn-sm"
									   onClick="
									   		event.preventDefault();
											confirm('Are you sure?');
											return document.getElementById('delete-form-{{ $role->id }}').submit();
									   ">
										<i class="fas fa-trash-alt"></i>
									</a>
									<form id="delete-form-{{ $role->id }}"
										  action="{{ route('admin.roles.destroy', ['role' => $role->id]) }}"
										  method="POST">
										@method('delete')
										@csrf
									</form>
								</div>
								{{-- Delete Link End --}}
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection