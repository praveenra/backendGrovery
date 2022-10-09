@extends('common.admin.header_script')
<div class="container">
    <div class="row" >
       <div class="col-sm-3"></div>
       <div class="col-sm-6" style="background-color:#EEFBFB;">
          <br/><br/>
          <center>
             <h2>LOGIN</h2>
          </center>
          <form class="form-horizontal" method="Get" action="{{url('/Dashboard')}}">
             <div class="form-group">
                <label class="control-label col-sm-12" for="email">Email:</label>
                <input type="email" name="email" placeholder="Email" class="form-control" required autofocus />
             </div>
             <div class="form-group">        
                <label class="control-label col-sm-12" for="password">Password:</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required />
             </div>
             <div class="form-group">        
                <input type="submit" value="Log In" name="submit" class="form-control" style="background-color:#15549a !important;color:#ffc107 !important;font-weight:bold !important;">
             </div>
          </form>
       </div>
       <div class="col-sm-3"></div>
    </div>
 </div>
 @extends('common.admin.footer_script')