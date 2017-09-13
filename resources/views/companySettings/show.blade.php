@extends('layouts.app')
@section('content')
<div class="panel-body">
    @include('common.errors')
    <div class="form-group">
        <label class="col-sm-3 control-label" for="role Name">
            Currency Name
        </label>
        <div class="col-sm-6">
            @if(isset($companySetting->currencyName))
            {{$companySetting->currencyName}}
            @endif
        </div>
    </div>
    <br/>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-6">
            <div class="col-sm-12">
            @if(isset($companySetting))
                <a href="/company-settings/{{$companySetting->id}}/edit">
                    <button class="btn btn-primary">
                        Edit Settings
                    </button>
                </a>
             
             @else
                 <a href="/company-settings/createSettings/{{$companyId}}">
                    <button class="btn btn-primary">
                        Add Settings
                    </button>
                </a>
             @endif   
            </div>
        </div>
    </div>
</div>
@endsection
