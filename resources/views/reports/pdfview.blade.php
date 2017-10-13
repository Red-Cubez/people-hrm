<style type="text/css">
	table td, table th{
		border:1px solid black;
	}
</style>
<div class="container">
<?php $counter=0; ?> 
	<br/>

	<a href="{{ URL('/company/projects/report/generateReport',['download'=>'pdf']) }}">Download PDF</a>

	<table>
		<tr>
			
			<th>Project Name</th>
			<th>Month And Year</th>
		</tr>
		@foreach ($monthlyTimelines as $key=>$monthlyTimeline)
		@if($counter>0)
		
		    <td>{{ ++$key }}</td>
		<td>{{ $monthlyTimeline[0]->projectName }}</td>
		
		
		@endif
		<?php $counter++; ?>
		@endforeach
	</table>
</div>



