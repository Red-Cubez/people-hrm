
@extends('layouts.app')

@section('content')

        
@if(count($monthlyTimelines) > 0)
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                    <?php
                    $data=null;
                    $data=serialize($monthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    
                  <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                        {{ csrf_field() }}
                    <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                    {{-- <input type="hidden" name="projectsType" value={{$projectsType}}> --}}
                        <a href="/company/{{$companyId}}/all-projects/report">
                            <button class="btn btn-primary">
                                Generate Pdf Report
                            </button>
                        </a>
                       
                    </form>

            </div>
            <div class="col-sm-4">
                <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
                   {{ csrf_field() }}
                   <input type="hidden" name="projectsTimelines" value="{{$data}}">
                   <button class="btn btn-primary" type="submit">Export to Ms Excel</button>
                </form>

            </div> 
            <div class="col-sm-4">
                <form action="{{route('company-reports.internal-projects-report')}}" enctype="multipart/form-data" method="post">
                      {{ csrf_field() }}
                      <input type="hidden" name="companyId" value="{{$companyId}}" />
                        <select name="fileExtension" >
                              <option></option>
                              <option value="pdf">Pdf</option>
                              <option value="xls">Excel</option>
                              <option value="doc">Word</option>
                              
                        </select>
                      <button class="btn btn-primary" type="submit">Generate Japser Report</button>
                </form>

            </div> 
       </div>
        <div class="row">
            <div class="col-sm-8">
                @include('reports/revenueGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('reports/monthlyCostGraph')

            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                @include('reports/monthlyProfitGraph')

            </div>
        </div>
        
    </div>
    @else
No Record Found    
@endif
@endsection
@section('page-scripts')
    @parent
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

@endsection
