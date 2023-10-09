@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Staff</h1>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 mt-2 font-weight-bold text-primary">View Staff</h6>
		<div class="float-right d-inline">
			<a href="{{ route('admin.staff.create') }}"
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
						<th>Photo</th>
						<th>Name</th>
						<th>Email</th>
						<th>Roles</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($admins as $admin)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td><img src="{{ asset('public/uploads/'.$admin->photo) }}"
								 alt=""
								 class="w_150"></td>
						<td>{{ $admin->name }}</td>
						<td>{{ $admin->email }}</td>
						<td>
							@foreach ($admin->roleNames() as $key => $role)
							<span style="font-size: 1.5em; color: #EEE">|</span>
							<span class="text-capitalize">{{ $role }}</span>
							@endforeach
						</td>
						<td>
							<div class="d-flex">
								{{-- Edit Link --}}
								<div class="p-1">
									@can("update-staff")
									<a href="{{ route('admin.staff.edit', ['staff' => $admin->id]) }}"
									   class="btn btn-warning btn-sm">
										<i class="fas fa-edit"></i>
									</a>
									@endcan
								</div>
								{{-- Edit Link End --}}
								{{-- Delete Link --}}
								<div class="p-1">
									@can("delete-staff")
									<a href="#"
									   class="btn btn-danger btn-sm"
									   onClick="
										event.preventDefault();
										confirm('Are you sure?');
										return document.getElementById('delete-form-{{ $admin->id }}').submit();">
										<i class="fas fa-trash-alt"></i>
									</a>
									@endcan
									<form id="delete-form-{{ $admin->id }}"
										  action="{{ route('admin.staff.destroy', ['staff' => $admin->id]) }}"
										  method="POST">
										@method('delete')
										@csrf
									</form>
								</div>
							</div>
							{{-- Delete Link End --}}
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection