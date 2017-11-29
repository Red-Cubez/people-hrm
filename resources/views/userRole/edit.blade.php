@extends('layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-9 col-md-offset-3">
                <div class="panel-body">
          @include('common.errors')
   <form  action="{{url('user-roles/'.$user->id) }}"  name="employeeForm" class="form-horizontal" method="POST">
            {{ csrf_field() }}
            {{method_field('PUT')}}
            @include('userRole/userRoleForm')
             </form>
              </div> 
            </div>
        </div>
    </div>
</section>
@endsection