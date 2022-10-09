@extends('layouts.seller')
@section('title','Seller') 
@section('content')
<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> create Store Settings </h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Seller</a></li>
            <li class="breadcrumb-item active" aria-current="page">create store settings</li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Store Settings</h4>
                <form method="post" action="{{route('saveSetting')}}" >
                  @csrf
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th>Opening Days</th>
                        <th>Opening Time</th>
                        <th>Closing Time</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[0][opening_day]" id="opening_day" class="form-control" value="Sunday" readonly disabled></td>
                        <td><input type="time" name="form_data[0][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[0][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[1][opening_day]" id="opening_day" class="form-control" value="Monday" readonly disabled></td>
                        <td><input type="time" name="form_data[1][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[1][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[2][opening_day]" id="opening_day" class="form-control" value="Tuesday" readonly disabled></td>
                        <td><input type="time" name="form_data[2][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[2][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[3][opening_day]" id="opening_day" class="form-control" value="Wednesday" readonly disabled></td>
                        <td><input type="time" name="form_data[3][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[3][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[4][opening_day]" id="opening_day" class="form-control" value="Thursday" readonly disabled></td>
                        <td><input type="time" name="form_data[4][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[4][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[5][opening_day]" id="opening_day" class="form-control" value="Friday" readonly disabled></td>
                        <td><input type="time" name="form_data[5][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[5][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                       <tr>
                        <td><input type="checkbox" name="check1" class="checkme"></td>
                        <td><input type="text" name="form_data[6][opening_day]" id="opening_day" class="form-control" value="Saturday" readonly disabled></td>
                        <td><input type="time" name="form_data[6][opening_time]" id="opening_time" class="form-control" disabled></td>
                        <td><input type="time" name="form_data[6][closing_time]" id="closing_time" class="form-control" disabled></td>
                      </tr>
                    </tbody>
                  </table>
				  	 
                  <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>

  $(function(){
        $('.checkme').click(function(){
          var closing_time = $(this).closest('tr').find('#closing_time');
          if($(this).is(':checked'))     
            closing_time.prop( "disabled", false );
          else
            closing_time.prop( "disabled", true );
        });
        $('.checkme').click(function(){
          var opening_time = $(this).closest('tr').find('#opening_time');
          if($(this).is(':checked'))     
            opening_time.prop( "disabled", false );
          else
            opening_time.prop( "disabled", true );
        });
         $('.checkme').click(function(){
          var opening_day = $(this).closest('tr').find('#opening_day');
          if($(this).is(':checked'))     
            opening_day.prop( "disabled", false );
          else
            opening_day.prop( "disabled", true );
        });
    })

$(document).ready(function(){
	
	var facility_id="{{$senddata->opening_day}}";
	
	var result=facility_id.split(',');
	  
	for(var i=0;i<=result.length;i++)
	{
		$("#open_"+result[i]).prop( "checked", true );
	}
	
	
	if({{$code}}=="1")
	{
     var uniquecode="{{uniqid()}}";
	 document.getElementById("code").value=uniquecode;
	}
});
</script>
@endsection