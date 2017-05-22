@extends('layouts.app')

@section('content')

    <div class="panel-body">
        @include('common.errors')
        <div>

            <label for="name" class="control-label">Name : </label>


            {{$company->name}}

        </div>
        <div>

            <label for="normalHoursPerWeek" class="control-label">Normal Hours / Week : </label>


            {{$company->normalHoursPerWeek}}

        </div>
        <div>

            <label for="applyOverTimeRule" class="control-label">Over Time Rule : </label>


            @if(($company->applyOverTimeRule)==1)
                Yes
            @elseif(($company->applyOverTimeRule==0))
                No
            @endif

        </div>
        <div>
            <label for="contactPerson" class="control-label">Street Line 1 : </label>

            {{$company->address->streetLine1 }}

        </div>
        <div>
            <label for="contactPerson" class="control-label">Street Line 2 : </label>

            {{$company->address->streetLine2 }}

        </div>
        <div>
            <label for="contactPerson" class="control-label">Country: </label>

            {{$company->address->country }}

        </div>
        <div>
            <label for="contactPerson" class="control-label">State / Province : </label>

            {{$company->address->stateProvince }}

        </div>

        <div>
            <label for="contactPerson" class="control-label">City</label>

            {{$company->address->city }}

        </div>


        <div>
            <label for="contactPerson" class="control-label">Company Job Titles: </label>

            @foreach($companyJobTitles as $companyJobTitle)
                {{$companyJobTitle->title}}
                {{  " | " }}
            @endforeach

        </div>

        <div>
            <label for="birthdate" class="col-sm-3 control-label">Birthday This Month:</label>
        </div>
        <div class="col-sm-3">
            <ol type="1">
                @foreach($employeesWithBirhthday as $employee)
                    <li>{{$employee->firstName}}
                        &nbsp
                        {{$employee->lastName}}

                        &nbsp -
                        &nbsp
                        
                        ({{date("d-m",strtotime(($employee->birthDate)))}})
                    </li>
                @endforeach

            </ol>
        </div>
    </div>




    <form action="{{ url('companies/'.$company->id.'/edit') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}

        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"> Edit</i>
        </button>
    </form>


    <form action="{{ url('/companies/'.$company->id.'/companyprojects') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}


        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"> Add New Projects</i>
        </button>
    </form>

    <form action="{{ url('jobtitle/'.$company->id) }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('GET') }}

        <button type="submit" class="btn btn-danger">
            <i class="fa fa-trash"> Add New Job Title</i>
        </button>
    </form>

    </div>
    @include('companyProjects/showProjects')

@endsection