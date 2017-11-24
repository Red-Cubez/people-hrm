@extends('layouts.app')
@section('content')
<article class="main-heading">
        <div class="container">
            <div class="row-content100">
                <div class="col-xs-12">
                    <h1 class="text-center">Company Setting</h1>
                </div>
            </div>
        </div>
    </article>
    <main class="showCompanySetting">
    <div class="container">
        <div class="row">
        @include('common.errors')
                        <div class="col-xs-12">
                            <div class="panel-body">
                                 <div class="col-md-6 col-md-offset-3">
                                  <ul class="list-group">
                                    <li class="list-group-item">      
                                         <div class="form-group">
                                         <label class="control-label" for="role Name">
                                         Currency Name:
                                         </label>
                                         @if(isset($companySetting->currencyName))
                                         {{$companySetting->currencyName}}
                                         @endif
                                        
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                     <div class="form-group">
                                        <label class="control-label" for="role Name">
                                            Currency Symbol:
                                        </label>
                                      
                                            @if(isset($companySetting->currencySymbol))
                                                {{$companySetting->currencySymbol}}
                                            @endif
                                         
                                    </div>     
                                    </li>
                                   <li class="list-group-item">
                                    <div class="form-group">
                                   
                                             <div class="company-setting-flex">
                                            @if(isset($companySetting))
                                                <a href="/company-settings/{{$companySetting->id}}/edit">
                                                   <i class="fa fa-pencil-square-o fa-2x"></i>
                                                </a>

                                            @else
                                                <a href="/company-settings/createSettings/{{$companyId}}">
                                                    <button  class="button button40">
                                                       <i class="fa fa-pencil-square-o fa-2x"></i>
                                                    </button>
                                                </a>
                                            @endif
                                           </div>
                                   
                                    </div>
                                    </li>
                              </ul>
                            </div>
            </div>
        </div>
    </div>
</main>
@endsection
