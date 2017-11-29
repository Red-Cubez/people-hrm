@extends('layouts.app')
@section('content')
    <article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Company</h1>
                </div>
            </div>
        </div>
    </article>
    <section>
        <div class="container-fluid">
            <div class="row row-content100">
                <div class="col-xs-12">
                    @permission(StandardPermissions::createDeleteCompanies)
                    <div class="text-center">
                        <a href="{{route('companies.create')}}">
                            <button class="button button40"> Add Company</button>
                        </a>
                    </div>
                    @endpermission
                </div>
            </div>
        </div>
    </section>
    @if(count($companies)>0)
    <section>
      <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Current Companies</h3>
            </div>
          <div class="panel-body">
              <div class="scroll-panel-table table-responsive">
                <table  class="table table-bordered table-hover table-striped">

                    <thead>
                    <tr>
                    <th>Name</th>
                    <th>Street Line 1</th>
                    <th>Street Line 2</th>
                    <th>Country</th>
                    <th>State / Province</th>
                    <th>City</th>
                     <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td >{{$company->name}}</td>
                            @if(isset($company->address))
                                <td >{{$company->address->streetLine1}}</td>
                                <td >{{$company->address->streetLine2}}</td>
                                <td >{{$company->address->country}}</td>
                                <td >{{$company->address->stateProvince}}</td>
                                <td >{{$company->address->city}}</td>
                            @else
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                                <td ></td>
                            @endif
                            <td>
                              @permission(StandardPermissions::createDeleteCompanies)
                                <form action="{{url('companies/'.$company->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    {{--<button type="submit" class="btn btn-danger" >--}}
                                        <i class="fa fa-trash fa-2x " data-toggle="confirmation" data-singleton="true"></i>
                                    {{--</button>--}}
                                </form>
                                @endpermission
                                <a href="{{route('companies.show', $company->id)}}">
                                    <button class="btn btn-primary"> View</button>
                                </a>

                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
              </div>
            </div>
        </div>  
    </section>
        
    @endif
<script type="text/javascript">
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  
});
</script>

@endsection

