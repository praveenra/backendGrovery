@extends('layout.user')
@section('content')
<style>
   table {
   display: table;
   border-collapse: separate;
   border-spacing: 2px;
   border-color: grey;
   width: 300px;
   }
   table {
   border-collapse: collapse;
   border-spacing: 0;
   }
   td, th {
   padding: 0;
   }
   .toooltip {
   position: absolute;
   white-space: nowrap;
   border-collapse: collapse;
   border: 1px solid;
   width: 16%;
   left: 50%;
   display:none 
   }
   .img_tooltip img {
   width: 45px;
   }
   .tree_img p {
   display: inline-block;
   font-weight: 600;
   margin-left: 4px;
   margin-right: 16px;
   }
   img:hover + .toooltip {
   display: table;
   }
   .tree_img img {
   width: 45px;
   }
   .tree_up_icon {
   width: 16px;
   height: 16px;
   margin-bottom: 2px;
   }
   .tree_down_icon {
   width: 16px;
   height: 16px;
   margin-top: 2px;
   }
   .tree_icon, .tree_up_icon, .tree_down_icon {
   cursor: pointer;
   }
   .tree_main {
   overflow: auto !important;
   }
   .tree_icon {
   width: 50px;
   }
   .demo_name_style {
   background-color: #fff;
   padding: 2px;
   border-radius: 2px;
   margin-top: 5px;
   margin-bottom: 0px;
   color: #222;
   border: 1px #ccc solid;
   border-radius: 5px;
   }
   .demo_name_style_red {
   background-color: #dd574c;
   padding: 2px;
   border-radius: 2px;
   margin-top: 5px;
   margin-bottom: 0px;
   color: white;
   }
   .demo_name_style_blue {
   background-color: #40b6e4;
   padding: 2px;
   border-radius: 2px;
   margin-top: 5px;
   margin-bottom: 0px;
   color: white;
   }
   .jOrgChart td {
   text-align: center;
   position: relative;
   vertical-align: top;
   padding: 0;
   }
   .jOrgChart .node {
   /* margin-bottom: -5px;
   */
   width: 110px;
   font-size: 12px !important;
   /* background-color: #35363B;
   */
   color: #428bca;
   }
   .jOrgChart .node {
   /* background-color: #35363B;
   */
   display: inline-block;
   width: 110px;
   margin: -5px 25px;
   z-index: 10;
   overflow: hidden;
   word-break: break-all 
   }
   .jOrgChart .down {
   background-color: #6F6F6F;
   margin: 0px auto;
   }
   .jOrgChart .username {
   overflow: hidden;
   width: auto;
   color: #FFFFFF;
   background: #807979;
   padding: 2px 8px;
   border-radius: 2px;
   }
   .jOrgChart .right {
   border-left: 2px solid white;
   }
   .jOrgChart .top {
   border-top: 2px solid #6F6F6F;
   }
   .jOrgChart td {
   text-align: center;
   vertical-align: top;
   padding: 0;
   }
   .jOrgChart .right {
   border-left: 2px solid white;
   }
   .jOrgChart .line {
   height: 24px;
   width: 2px;
   }
   .jOrgChart td {
   text-align: center;
   vertical-align: top;
   padding: 0;
   }
   .jOrgChart .left {
   border-right: 2px solid #6F6F6F;
   }
   .orgChart {
   overflow:auto;
   margin-top: 30px;
   transform-origin: 0% 0% 0px !important;
   }
   .jOrgChart {
   margin-top: 26px;
   }
   @media (min-width:1920px){
   .toooltip {
   left: 47% !important;
   }
   }
   @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
   .toooltip {
   width: 30% !important;
   }
   }
   @media (max-width:768px){
   .toooltip {
   width: 30% !important;
   left: 45% !important;
   }
   }
   @media (max-width:767px){
   .toooltip {
   width: 64% !important;
   left: 15% !important;
   }
   }
   .tree_img_tree {
   width: 300px;
   }
   .Demo_head_bg {
   background-color: #37a1fd;
   padding: 5px;
   text-align: center;
   }
   .tree_img_tree img {
   width: 25px;
   height: 25px;
   border-radius: 500px;
   }
   .binary_bg {
   background-color: #f0f3f4;
   text-align: center;
   padding: 8px 13px 10px;
   }
   .binary_bg p {
   margin:0px;
   }
   .body_text_tree {
   font-size: 13px;
   }
   .list-group {
   padding-left: 0;
   margin-bottom: 0px;
   }
   .no-radius {
   border-radius: 0;
   }
   .list-group.no-radius .list-group-item {
   border-radius: 0 !important;
   }
   .list-group-item:first-child {
   border-top-left-radius: 4px;
   border-top-right-radius: 4px;
   }
   .list-group-item {
   position: relative;
   display: block;
   padding: 8px 13px 10px;
   margin-bottom: -1px;
   background-color: #fff;
   border: 1px solid #ddd;
   }
   .list-group.no-radius{
   display: block;
   width: 100%;
   }
   .list-group.no-radius li {
   width: 150px;
   float: left;
   }
   .node_parent{
   top: -24px;
   position: absolute;
   width: 98%;
   }
</style>
<div class="row">
<div class="col-lg-12">
<div class="card">
<div class="card-header"><i class="fa fa-table"></i>Genealogy  </div>
<div class="card-body">
   <div class="tab-container full-width-style arrow-left dashboard">
      <div class="tab-content">
         <div class="binary_tree">
            <?php 
               use App\User;
               
               $parent_id=User::where('username','=',$userid)->with('package','todayuser')->first();
               $package_name='Free Registration, ';
               $total_package_details=0;
                   if($parent_id){
                   $total_amount_details = $parent_id->totaltopups;
                   foreach($total_amount_details as $total_amount_detail){
                       $package_name.=$total_amount_detail->totalpackages->pk_name;
                       $total_package_details+=$total_amount_detail->totalpackages->pk_amount;
               
                   }
               }        
               ?>
            @if($parent_id)
            <div class="">
               <div class="col-xs-12">
                  <div class="col-xs-12 text-center">
                     <form class="form-horizontal" action={{url('user/genealogy/searchgenelogy/')}} style="padding:10px;" method="get">
                        <div class="form-group">
                           <label for="inputEmail3" class="col-sm-12 control-label">Enter Id To search</label>
                           <div class="col-sm-5" style="margin: 10px auto;">
                              <input type="text" class="form-control" id="inputEmail3" name="id" placeholder="Enter Id To search" required="">
                           </div>
                           <div class="col-sm-12">
                              <button type="submit" class="btn btn-default">Submit</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="orgChart" id="tree" style="margin:0px;">
               <div class="jOrgChart" >
                  <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center" style="zoom: 1; transform-origin: 0px 0px 0px; float: none !important; margin: auto !important;">
                     <tbody>
                        <tr class="node-cells">
                           <td class="node-cell" colspan="4">
                              <div class="node_parent" >
                                 <div class="pull-left">
                                    <?php $amount = 0;?>
                                    Today Left BV : {{auth()->user()->NowLeft}}
                                 </div>
                                 <div class="pull-right">
                                    <?php $amount = 0;?>
                                    Today Right BV :  {{auth()->user()->NowRight}}
                                 </div>
                              </div>
                              <div class="node" style="cursor: default;">
                                 <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/reg_user.png')}}"  data-tooltip-content="#user_{{$parent_id->username}}">
                                 <p class="demo_name_style">{{Auth::user()->username}}</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>
                           <td align="center" width="100%" colspan="4">
                              <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="701">
                           </td>
                        </tr>
                        <tr>
                           @if($parent_id)
                           <!-- Left Child -->
                           @if($parent_id->left_child)
                           <?php $leftchild=$parent_id->left_child ?>
                           <td class="node-container left_child_main left_child" colspan="2">
                              <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                 <tbody>
                                    <tr class="node-cells">
                                       <td class="node-cell" colspan="4">
                                          <div class="node" style="cursor: default;">
                                             <a href="{{url('user/genealogy/viewgenealogy/'.$leftchild->username)}}" >
                                                <img class="tree_icon with_tooltip" src="{{url('assets/user/images/reg_user.png')}}" data-tooltip-content="#user_{{$leftchild->username}}">
                                                <p class="demo_name_style">{{$leftchild->username}}</p>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       <td align="center" width="100%" colspan="4">
                                          <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                       </td>
                                    </tr>
                                    <tr>
                                       @if($leftchild->left_child)
                                       <?php $left_left_child_main_l1=$leftchild->left_child; ?>
                                       <td class="node-container left_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/genealogy/viewgenealogy/'.$left_left_child_main_l1->username)}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/reg_user.png')}}" data-tooltip-content="#user_{{$left_left_child_main_l1->username}}">
                                                            <p class="demo_name_style">{{$left_left_child_main_l1->username}}</p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @else
                                       <td class="node-container left_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @endif
                                       @if($leftchild->rightrow)
                                       <?php $left_right_child_main_l1=$leftchild->right_child;  ?>
                                       <td class="node-container left_right_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/genealogy/viewgenealogy/'.$left_right_child_main_l1->username)}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/reg_user.png')}}"  data-tooltip-content="#user_{{$left_right_child_main_l1->username}}">
                                                            <p class="demo_name_style">{{$left_right_child_main_l1->username}}</p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @else
                                       <td class="node-container left_right_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}">
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}" >
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @endif
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           @else
                           <!-- Left Child Empty-->
                           <td class="node-container left_child_main left_child" colspan="2">
                              <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                 <tbody>
                                    <tr class="node-cells">
                                       <td class="node-cell" colspan="4">
                                          <div class="node" style="cursor: default;">
                                             <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                <p class="demo_name_style">Add User <br/> </p>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       <td align="center" width="100%" colspan="4">
                                          <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="node-container left_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/add_user.png')}}" >
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td class="node-container left_right_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}">
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}" >
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           @endif
                           <!-- Right Child -->
                           @if($parent_id->rightrow)
                           <?php $rightchild=$parent_id->right_child ?>
                           <td class="node-container right_child_main right_child" colspan="2">
                              <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                 <tbody>
                                    <tr class="node-cells">
                                       <td class="node-cell" colspan="4">
                                          <div class="node" style="cursor: default;">
                                             <a href="{{url('user/genealogy/viewgenealogy/'.$rightchild->username)}}" >
                                                <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/reg_user.png')}}" onclick="getGenologyTree(&quot;SBC123867&quot;,event);" data-tooltip-content="#user_{{$rightchild->username}}">
                                                <p class="demo_name_style">{{$rightchild->username}}</p>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       <td align="center" width="100%" colspan="4">
                                          <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                       </td>
                                    </tr>
                                    <tr>
                                       @if($rightchild->left_child)
                                       <?php $right_left_child_main_l1=$rightchild->left_child; ?>
                                       <td class="node-container right_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node">
                                                         <a href="{{url('user/genealogy/viewgenealogy/'.$right_left_child_main_l1->username)}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/reg_user.png')}}"  data-tooltip-content="#user_{{$right_left_child_main_l1->username}}">
                                                            <p class="demo_name_style">{{$right_left_child_main_l1->username}}</p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @else
                                       <td class="node-container right_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @endif
                                       @if($rightchild->right_child)
                                       <?php $right_right_child_main_l1=$rightchild->right_child; ?>
                                       <td class="node-container right_right_child_main_l1 right_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/genealogy/viewgenealogy/'.$right_right_child_main_l1->username)}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/reg_user.png')}}" data-tooltip-content="#user_{{$right_right_child_main_l1->username}}">
                                                            <p class="demo_name_style">{{$right_right_child_main_l1->username}}</p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @else
                                       <td class="node-container right_right_child_main_l1 right_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}" >
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       @endif
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           @else
                           <td class="node-container right_child_main right_child" colspan="2">
                              <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                 <tbody>
                                    <tr class="node-cells">
                                       <td class="node-cell" colspan="4">
                                          <div class="node" style="cursor: default;">
                                             <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                <p class="demo_name_style">Add User <br/> </p>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       <td align="center" width="100%" colspan="4">
                                          <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="node-container right_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td class="node-container right_right_child_main_l1 right_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           @endif
                           @else 
                           <!-- Left Child Empty-->
                           <td class="node-container left_child_main left_child" colspan="2">
                              <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                 <tbody>
                                    <tr class="node-cells">
                                       <td class="node-cell" colspan="4">
                                          <div class="node" style="cursor: default;">
                                             <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}" >
                                                <p class="demo_name_style">Add User <br/> </p>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       <td align="center" width="100%" colspan="4">
                                          <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="node-container left_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                            <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                   <td align="center" width="100%" colspan="4">
                                                      <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td class="node-container left_left_left_child_main_l2 left_child" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                                        <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/add_user.png')}}">
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                   <td class="node-container left_left_right_child_main_l2" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                                        <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/add_user.png')}}" >
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td class="node-container left_right_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}">
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                   <td align="center" width="100%" colspan="4">
                                                      <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td class="node-container left_right_left_child_main_l2 left_child" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/')}}/{{$parent_id->username}}/{{'1'}}">
                                                                        <img class="tree_icon with_tooltip tooltipstered" src="{{url('assets/user/images/add_user.png')}}" >
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                   <td class="node-container  left_right_right_child_main_l2 left_child" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/')}}/{{$parent_id->username}}/{{'0'}}">
                                                                        <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           <!-- Right Child Empty-->
                           <td class="node-container right_child_main right_child" colspan="2">
                              <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                 <tbody>
                                    <tr class="node-cells">
                                       <td class="node-cell" colspan="4">
                                          <div class="node" style="cursor: default;">
                                             <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}" >
                                                <p class="demo_name_style">Add User <br/> </p>
                                             </a>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                       <td align="center" width="100%" colspan="4">
                                          <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                       </td>
                                    </tr>
                                    <tr>
                                       <td class="node-container right_left_child_main_l1 left_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}" >
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                   <td align="center" width="100%" colspan="4">
                                                      <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td class="node-container right_left_left_child_main_l2" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                                        <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                   <td class="node-container right_left_right_child_main_l2" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                                        <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td class="node-container right_right_child_main_l1 right_child" colspan="2">
                                          <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                             <tbody>
                                                <tr class="node-cells">
                                                   <td class="node-cell" colspan="4">
                                                      <div class="node" style="cursor: default;">
                                                         <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                            <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                            <p class="demo_name_style">Add User <br/> </p>
                                                         </a>
                                                      </div>
                                                   </td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                   <td align="center" width="100%" colspan="4">
                                                      <img height="49" src="{{url('assets/user/images/gen_image.png')}}" width="350">
                                                   </td>
                                                </tr>
                                                <tr>
                                                   <td class="node-container right_right_left_child_main_l1 right_child" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'1')}}" >
                                                                        <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                   <td class="node-container right_right_right_child_main_l1 right_child" colspan="2">
                                                      <table id="tree_div" cellpadding="0" cellspacing="0" border="0" align="center">
                                                         <tbody>
                                                            <tr class="node-cells">
                                                               <td class="node-cell" colspan="2">
                                                                  <div class="node">
                                                                     <a href="{{url('user/users/treeadd/'.$parent_id->username.'/'.'0')}}" >
                                                                        <img class="tree_icon with_tooltip" src="{{url('assets/user/images/add_user.png')}}">
                                                                        <p class="demo_name_style">Add User <br/> </p>
                                                                     </a>
                                                                  </div>
                                                               </td>
                                                            </tr>
                                                         </tbody>
                                                      </table>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                           @endif
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div id="tooltip_div" style="display:none;">
               <div id="user_{{$parent_id->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$parent_id->first_name}} - {{$parent_id->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($parent_id->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($parent_id->total_bv) ? $parent_id->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($parent_id->left_count) ? $parent_id->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($parent_id->right_count) ? $parent_id->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($parent_id->left_bv) ? $parent_id->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($parent_id->right_bv) ? $parent_id->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @if(isset($leftchild))
               <div id="user_{{$leftchild->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$leftchild->first_name}} - {{$leftchild->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($leftchild->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($leftchild->total_bv) ? $leftchild->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($leftchild->left_count) ? $leftchild->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($leftchild->right_count) ? $leftchild->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($leftchild->left_bv) ? $leftchild->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($leftchild->right_bv) ? $leftchild->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($left_left_child_main_l1))
               <div id="user_{{$left_left_child_main_l1->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$left_left_child_main_l1->first_name}} - {{$left_left_child_main_l1->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($left_left_child_main_l1->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_child_main_l1->total_bv) ? $left_left_child_main_l1->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_child_main_l1->left_count) ? $left_left_child_main_l1->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_child_main_l1->right_count) ? $left_left_child_main_l1->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_child_main_l1->left_bv) ? $left_left_child_main_l1->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_child_main_l1->right_bv) ? $left_left_child_main_l1->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($left_right_child_main_l1))
               <div id="user_{{$left_right_child_main_l1->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$left_right_child_main_l1->first_name}} - {{$left_right_child_main_l1->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($left_right_child_main_l1->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_child_main_l1->total_bv) ? $left_right_child_main_l1->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_child_main_l1->left_count) ? $left_right_child_main_l1->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_child_main_l1->right_count) ? $left_right_child_main_l1->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_child_main_l1->left_bv) ? $left_right_child_main_l1->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_child_main_l1->right_bv) ? $left_right_child_main_l1->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($left_left_left_child_main_l2))
               <div id="user_{{$left_left_left_child_main_l2->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$left_left_left_child_main_l2->first_name}} - {{$left_left_left_child_main_l2->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($left_left_left_child_main_l2->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_left_child_main_l2->total_bv) ? $left_left_left_child_main_l2->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_left_child_main_l2->left_count) ? $left_left_left_child_main_l2->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_left_child_main_l2->right_count) ? $left_left_left_child_main_l2->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_left_child_main_l2->left_bv) ? $left_left_left_child_main_l2->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_left_child_main_l2->right_bv) ? $left_left_left_child_main_l2->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($left_left_right_child_main_l2))
               <div id="user_{{$left_left_right_child_main_l2->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$left_left_right_child_main_l2->first_name}} - {{$left_left_right_child_main_l2->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($left_left_right_child_main_l2->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_right_child_main_l2->total_bv) ? $left_left_right_child_main_l2->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_right_child_main_l2->left_count) ? $left_left_right_child_main_l2->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_right_child_main_l2->right_count) ? $left_left_right_child_main_l2->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_right_child_main_l2->left_bv) ? $left_left_right_child_main_l2->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_left_right_child_main_l2->right_bv) ? $left_left_right_child_main_l2->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($left_right_left_child_main_l2))
               <div id="user_{{$left_right_left_child_main_l2->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$left_right_left_child_main_l2->first_name}} - {{$left_right_left_child_main_l2->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($left_right_left_child_main_l2->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_left_child_main_l2->total_bv) ? $left_right_left_child_main_l2->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_left_child_main_l2->left_count) ? $left_right_left_child_main_l2->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_left_child_main_l2->right_count) ? $left_right_left_child_main_l2->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_left_child_main_l2->left_bv) ? $left_right_left_child_main_l2->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_left_child_main_l2->right_bv) ? $left_right_left_child_main_l2->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($left_right_right_child_main_l2))
               <div id="user_{{$left_right_right_child_main_l2->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$left_right_right_child_main_l2->first_name}} - {{$left_right_right_child_main_l2->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($left_right_right_child_main_l2->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_right_child_main_l2->total_bv) ? $left_right_right_child_main_l2->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_right_child_main_l2->left_count) ? $left_right_right_child_main_l2->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_right_child_main_l2->right_count) ? $left_right_right_child_main_l2->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_right_child_main_l2->left_bv) ? $left_right_right_child_main_l2->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($left_right_right_child_main_l2->right_bv) ? $left_right_right_child_main_l2->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($rightchild))
               <div id="user_{{$rightchild->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$rightchild->first_name}} - {{$rightchild->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($rightchild->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($rightchild->total_bv) ? $rightchild->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($rightchild->left_count) ? $rightchild->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($rightchild->right_count) ? $rightchild->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($rightchild->left_bv) ? $rightchild->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($rightchild->right_bv) ? $rightchild->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($right_left_child_main_l1))
               <div id="user_{{$right_left_child_main_l1->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$right_left_child_main_l1->first_name}} - {{$right_left_child_main_l1->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($right_left_child_main_l1->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_child_main_l1->total_bv) ? $right_left_child_main_l1->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_child_main_l1->left_count) ? $right_left_child_main_l1->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_child_main_l1->right_count) ? $right_left_child_main_l1->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_child_main_l1->left_bv) ? $right_left_child_main_l1->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_child_main_l1->right_bv) ? $right_left_child_main_l1->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($right_right_child_main_l1))
               <div id="user_{{$right_right_child_main_l1->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$right_right_child_main_l1->first_name}} - {{$right_right_child_main_l1->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($right_right_child_main_l1->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_child_main_l1->total_bv) ? $right_right_child_main_l1->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_child_main_l1->left_count) ? $right_right_child_main_l1->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_child_main_l1->right_count) ? $right_right_child_main_l1->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_child_main_l1->left_bv) ? $right_right_child_main_l1->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_child_main_l1->right_bv) ? $right_right_child_main_l1->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($right_left_left_child_main_l2))
               <div id="user_{{$right_left_left_child_main_l2->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$right_left_left_child_main_l2->first_name}} - {{$right_left_left_child_main_l2->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($right_left_left_child_main_l2->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_left_child_main_l2->total_bv) ? $right_left_left_child_main_l2->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_left_child_main_l2->left_count) ? $right_left_left_child_main_l2->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_left_child_main_l2->right_count) ? $right_left_left_child_main_l2->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_left_child_main_l2->left_bv) ? $right_left_left_child_main_l2->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_left_child_main_l2->right_bv) ? $right_left_left_child_main_l2->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($right_left_right_child_main_l2))
               <div id="user_{{$right_left_right_child_main_l2->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$right_left_right_child_main_l2->first_name}} - {{$right_left_right_child_main_l2->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($right_left_right_child_main_l2->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_right_child_main_l2->total_bv) ? $right_left_right_child_main_l2->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_right_child_main_l2->left_count) ? $right_left_right_child_main_l2->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_right_child_main_l2->right_count) ? $right_left_right_child_main_l2->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_right_child_main_l2->left_bv) ? $right_left_right_child_main_l2->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_left_right_child_main_l2->right_bv) ? $right_left_right_child_main_l2->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($right_right_left_child_main_l1))
               <div id="user_{{$right_right_left_child_main_l1->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$right_right_left_child_main_l1->first_name}} - {{$right_right_left_child_main_l1->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($right_right_left_child_main_l1->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_left_child_main_l1->total_bv) ? $right_right_left_child_main_l1->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_left_child_main_l1->left_count) ? $right_right_left_child_main_l1->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_left_child_main_l1->right_count) ? $right_right_left_child_main_l1->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_left_child_main_l1->left_bv) ? $right_right_left_child_main_l1->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_left_child_main_l1->right_bv) ? $right_right_left_child_main_l1->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
               @if(isset($right_right_right_child_main_l1))
               <div id="user_{{$right_right_right_child_main_l1->username}}" class="tree_img_tree">
                  <div class="Demo_head_bg">
                     <img src="{{url('assets/user/images/reg_user.png')}}">
                     <p></p>
                  </div>
                  <div class="body_text_tree">
                     <div class="binary_bg">
                        <p class="text-center">{{$right_right_right_child_main_l1->first_name}} - {{$right_right_right_child_main_l1->username}}</p>
                     </div>
                     <ul class="list-group no-radius">
                        <li class="list-group-item">
                           <div class="pull-right">{{date('d-m-Y', strtotime($right_right_right_child_main_l1->doj)) }}</div>
                           <div class="pull-left">Date:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_right_child_main_l1->total_bv) ? $right_right_right_child_main_l1->total_bv : 0 }}</div>
                           <div class="pull-left">Total Topup: </div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_right_child_main_l1->left_count) ? $right_right_right_child_main_l1->left_count : 0}}</div>
                           <div class="pull-left">Left Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_right_child_main_l1->right_count) ? $right_right_right_child_main_l1->right_count : 0}}</div>
                           <div class="pull-left">Right Count:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_right_child_main_l1->left_bv) ? $right_right_right_child_main_l1->left_bv : 0 }}</div>
                           <div class="pull-left">Left BV:</div>
                        </li>
                        <li class="list-group-item">
                           <div class="pull-right">{{($right_right_right_child_main_l1->right_bv) ? $right_right_right_child_main_l1->right_bv : 0 }}</div>
                           <div class="pull-left">Right BV:</div>
                        </li>
                     </ul>
                  </div>
               </div>
               @endif
            </div>
            @endif
         </div>
      </div>
   </div>
</div>
@stop