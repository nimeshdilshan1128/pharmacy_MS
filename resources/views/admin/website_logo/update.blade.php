@extends('admin.layouts.app')
@section('content')

	<div class="pagetitle">
		<h1>Website Logo Update</h1>
	</div>

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
                @include('_message')
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Website Logo Update</h5>

						<!--<form action="{{ ('admin/website_logo_update') }}" method="post" enctype="multipart/form-data"> -->
						<form action="{{ url('admin/website_logo_update') }}" method="post" enctype="multipart/form-data">
	
                            {{ csrf_field() }}
							

                            <div class="row mb-3">
								<label class="col-sm-2 col-form-label"> Name <span style="color: red;">*</span></label>
								<div class="col-sm-10">
									<input type="text" name="website_name"
									class="form-control" required value="{{$getRecord->website_name}}">
								</div>
							</div>

							<div class="row mb-3">
								<label class="col-sm-2 col-form-label"> Website Logo <span style="color: red;">*</span></label>
								<div class="col-sm-10">
									<input class="form-control" name="logo" type="file" id="formFile">	

                                    @if (!empty($getRecord->logo))
                                    <img src="{{ $getRecord->getLogo() }}" height="100px" width="100px">
                                    
                                    @endif
								</div>
							</div>

                           
							<div class="row mb-3">
								<label class="col-sm-2 col-form-label"></label>
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary">Update</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
			
		</div>
		
	</section>

@endsection