@extends('layout.app')
@section('title','Visitor Info')


@section('content')

<div class="container">
<div class="row">
<div class="col-md-12 p-5">
<table id="VisitorDt" class="table table-striped table-sm table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">NO</th>
	  <th class="th-sm">IP</th>
	  <th class="th-sm">Date & Time</th>
    </tr>
  </thead>
  <tbody>
    @foreach($visitordata as $visitordata)
    <tr>
      <td>{{$visitordata->id}}</td>
      <td>{{$visitordata->ip_address}}</td>
      <td>{{$visitordata->visit_time}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

</div>
</div>
</div>


@endsection