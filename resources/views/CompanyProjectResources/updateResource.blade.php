@extends('layouts.app')
@section('content')
<section>
	<div class="container">
		<div class="row row-content">
			<div class="col-xs-12 col-md-7 col-md-offset-4">
				
				 <div class="panel-body">

        @include('common.errors')
        <form id="resourceForm" action="{{url('companyprojectresources') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            @include('projectResources/fixedResourcesForm')
        </form>
    </div>
			</div>
		</div>
	</div>
</section>
   
@endsection
  