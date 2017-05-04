<form action="{{ url('projectresources/') }}" method="POST" class="form-horizontal">
 {{ csrf_field() }}
 {{ method_field('POST') }}
 
  
   
   <div class="form-group">
     <label class="col-sm-3 control-label">Title</label>
       <div class="col-sm-6">
         @if(!isset($projectresources))
         <input type="hidden" name="clientProjectid" value="{{ $clientProjectid }}" class="form-control">
         @elseif(isset($projectresources))
         <input type="hidden" name="clientProjectid" value="{{ $projectresources[0]->client_project_id
          }}" class="form-control">
         @endif
         <input type="text" name="title" id="title" class="form-control" @if(isset($projectresources[0]->title)) value="{{$projectresources[0]->title}}" @else placeholder="Enter title"@endif class="form-control" required>
       </div>
   </div>

   <div class="form-group">
     <label class="col-sm-3 control-label">Expected Start date</label>
       <div class="col-sm-6">       
          <input type="date" name="expectedStartDate" id="expectedStartDate" class="form-control" class="form-control" @if(isset($projectresources)) value="{{$projectresources[0]->expectedStartDate}}" @endif>
       </div>
   </div>

   <div class="form-group">
     <label class="col-sm-3 control-label">Expected End date</label>
       <div class="col-sm-6">   
          <input type="date" name="expectedEndDate" id="expectedEndDate" class="form-control" class="form-control" @if(isset($projectresources)) value="{{$projectresources[0]->expectedEndDate}}" @endif>
       </div>
   </div>

   <div class="form-group">
      <label class="col-sm-3 control-label">Actual Start date</label>
        <div class="col-sm-6">   
           <input type="date" name="actualStartDate" id="actualStartDate" class="form-control" class="form-control" @if(isset($projectresources)) value="{{$projectresources[0]->actualStartDate}}" @endif>
        </div>
   </div>

   <div class="form-group">
      <label class="col-sm-3 control-label">Actual End date</label>
        <div class="col-sm-6">   
          <input type="date" name="actualEndDate" id="title" class="actualEndDate" class="form-control" @if(isset($projectresources)) value="{{$projectresources[0]->actualEndDate}}" @endif>
        </div>
   </div>

   <div class="form-group">
      <label class="col-sm-3 control-label">Hourly billing Rate</label>
        <div class="col-sm-6">   
           <input type="Number" name="hourlyBillingRate" id="hourlyBillingRate" class="form-control" class="form-control" @if(isset($projectresources)) value="{{$projectresources[0]->hourlyBillingRate}}" @endif>
        </div>
   </div>

   <div class="form-group">
     <label class="col-sm-3 control-label">Hours Per week</label>
        <div class="col-sm-6">   
           <input type="Number" name="hoursPerWeek" id="hoursPerWeek" class="form-control" class="form-control" @if(isset($projectresources)) value="{{$projectresources[0]->hoursPerWeek}}" @endif>
        </div>
   </div>

   <div class="form-group">
      <div class="col-sm-offset-3 col-sm-6">
         <button type="submit" class="btn btn-danger">
         @if(isset($projectresources))
             <i class="fa fa-trash"> Update </i>
              <input type="hidden" name="projectResourceId" value="{{ $projectresources[0]->id}}" class="form-control">

          @else   
           <i class="fa fa-trash"> Add </i>
         </button>
         @endif
      </div>
   </div>

</form>  