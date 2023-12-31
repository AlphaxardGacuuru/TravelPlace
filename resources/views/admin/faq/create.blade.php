@extends('admin.admin_layouts')
@section('admin_content')
<h1 class="h3 mb-3 text-gray-800">Add FAQ</h1>

<form action="{{ route('admin.faq.store') }}"
	  method="post">
	@csrf
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 mt-2 font-weight-bold text-primary">Add FAQ</h6>
			<div class="float-right d-inline">
				<a href="{{ route('admin.faq.index') }}"
				   class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> View All</a>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">FAQ Title *</label>
						<input type="text"
							   name="faq_title"
							   class="form-control"
							   value="{{ old('faq_title') }}"
							   autofocus>
					</div>
					<div class="form-group">
						<label for="">FAQ Content *</label>
						<textarea name="faq_content"
								  class="form-control editor"
								  cols="30"
								  rows="10">{{ old('faq_content') }}</textarea>
					</div>
					<div class="form-group">
						<label for="">FAQ Order</label>
						<input type="text"
							   name="faq_order"
							   class="form-control"
							   value="{{ old('faq_order', '0') }}">
					</div>
				</div>
			</div>
			@can("create-web-section")
			<button type="submit"
					class="btn btn-success">Submit</button>
			@endcan
		</div>
	</div>
</form>

@endsection