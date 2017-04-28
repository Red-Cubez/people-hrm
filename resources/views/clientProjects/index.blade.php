    @extends('layouts.app')

    @section('content')

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New clientProject Form -->
            <form action="{{url('clientprojects') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

               <div class="form-group" >
               <input type="hidden" name="clientid" value="{{$clientid}}">
               </div>
                @include('clientProjects/clientProjectForm')

               </form>
        </div>
            <!-- Current clientProjects -->
       @if(isset($clientprojects))
       @include('clientProjects/showProjects')
       @endif
    @endsection