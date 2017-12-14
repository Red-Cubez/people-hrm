@extends('layouts.app')
@section('content')
@if(count($monthlyTimelines) > 0)

<section class="showIndivisualProjectGraphSection">
<div class="container-fluid">
<div class="row row-content100">
            <div class="col-sm-12 col-xs-12 col-md-10 col-md-offset-1">
                    <?php $data=null; $data=serialize($monthlyTimelines); 
                    //$encoded=htmlentities($data); 
                    ?>
                    <div class="aParent">
              <form action="{{url('company/projects/report/generateReport')}}" class="form-horizontal" method="POST" role="form">
                    {{ csrf_field() }}
                  <input type="hidden" name="monthlyTimelines" value="{{$data}}">
                  {{-- <input type="hidden" name="projectsType" value={{$projectsType}}> --}}
                  <a href="/company/{{$companyId}}/all-projects/report">
                  <button class="button button40">
                  Generate Pdf Report
                  </button>
                  </a>
             </form>
             <form action="{{url('/company/projects/report/export')}}" enctype="multipart/form-data" method="post">
             {{ csrf_field() }}
            <input type="hidden" name="projectsTimelines" value="{{$data}}">
            <button class="button button40" type="submit">Export to Ms Excel</button>
          </form>
          </div>
           </div>
</div>
<div class="row row-content100">
 <div class="col-sm-12 col-xs-12 col-md-12  ">
  @include('reports/revenueGraph')
  </div>
</div>
 <div class="row row-content100">
  <div class="col-sm-12 col-xs-12 col-md-12">
    @include('reports/monthlyCostGraph')
  </div>
</div>
<div class="row row-content100">
  <div class="col-sm-12 col-xs-12 col-md-12">
     @include('reports/monthlyProfitGraph')
      </div>
 </div>
 </div>
</section>
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
