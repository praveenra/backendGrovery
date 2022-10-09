@extends('layouts.admin')
@section('title','Orders') 
@section('content')

<style type="text/css">
   .approve a{
        color: #007bff;
        font-weight: 200;
   }
   .approve a:hover{
        text-decoration: none;
        font-weight: bolder;
   }

    .container {
        margin: 200px auto
    }

    fieldset {
        display: none
    }

    fieldset.show {
        display: block
    }

    select:focus,
    input:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 1px solid #2196F3 !important;
        outline-width: 0 !important;
        font-weight: 400
    }

    button:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        outline-width: 0
    }

    .tabs {
        margin: 2px 5px 0px 5px;
        padding-bottom: 10px;
        cursor: pointer
    }

    .tabs:hover,
    .tabs.active {
        border-bottom: 1px solid #2196F3;
        color: #2196F3;
    }

    a:hover {
        text-decoration: none;
        color: #1565C0
    }

    .box {
        margin-bottom: 10px;
        border-radius: 5px;
        padding: 10px
    }

    .line {
        background-color: #CFD8DC;
        height: 1px;
        width: 100%
    }

    @media screen and (max-width: 768px) {
        .tabs h6 {
            font-size: 12px
        }
    }


    @font-face {
        font-family: Proxima Nova Regular;
        src: url(../fonts/proximanovaregular.otf);
    }

    button.close {
        /* top: 401px; */
        padding: 0px;
        width: 20px;
        height: 20px;
        background: #F8A631 0% 0% no-repeat padding-box;
        border-radius: 4px;
        opacity: 0.2;
        margin: 0px;
        top: 15px;
        right: 15px;
        position: absolute;
    }

    .pop-content {
        width: 631px;
        height: 149px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border-radius: 8px;
        opacity: 1;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
    }

    .pop-content .cancel {
        width: 25px;
        height: 25px;
        background: #F9FAFC 0% 0% no-repeat padding-box;
        border: 1px solid #CFD6E3;
        opacity: 1;
        border-radius: 50%;
    }

    .pop-content .cancel p {
        padding: 1px 0px 0px 8px;
        color: #CFD6E3;
    }

    .pop-content .popmessage p {
        text-align: left;
        font: normal normal 600 23px/56px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
        padding-top: 10px;
    }

    .m-content {
        position: relative;
        width: 100%;
        height: 144px;
        background: #F5F5F5 0% 0% no-repeat padding-box;
        opacity: 1;
    }

    .come-from-modal.right .modal-body {
        padding-top: 0px;
        padding-left: 0px;
        padding-right: 0px;
    }

    .m-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 40px 10px 40px;
    }

    .m-inner-01 {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0px 20px 0px 40px;
    }

    .m-inner h5 {
        text-align: left;
        font: normal normal 600 18px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    .m-close {
        width: 20px;
        height: 20px;
        background: #F8A631 0% 0% no-repeat padding-box;
        border-radius: 4px;
        opacity: 0.2;
        float: right;
    }

    .m-close p {
        padding: 2px 0px 0px 7px;
        color: #4c2e03;
    }

    .m-inner-01 .p-img {
        margin-right: 16px;
    }

    .m-inner-01 .p-img img {
        width: 50px;
        height: 40px;
    }

    .p-desc h4 {
        text-align: left;
        font: normal normal normal 12px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #969A9F;
        opacity: 1;
    }

    .p-desc h4 span {
        text-align: left;
        font: normal normal normal 14px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    .od-txt-01 {
        text-align: left;
        font: normal normal normal 12px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #969A9F;
        opacity: 1;
    }

    .ordertable tr td {
        text-align: left;
        font: normal normal normal 14px/18px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;

        padding-bottom: 10px;
    }

    .m-bottom {
        position: absolute;
        width: 257px;
        bottom: -19px;
        left: 55px;
        height: 33px;
        background: #FFE1B5 0% 0% no-repeat padding-box;
        border-radius: 20px;
        opacity: 1;
    }

    .m-bottom p {
        float: right;
    }

    .m-bottom h5 {
        padding-left: 18px;
        text-align: left;
        font: normal normal 600 14px/28px Proxima Nova Regular;
        letter-spacing: 0.5px;
        color: #F8A631;
        opacity: 1;
    }

    .od-txt-03 {
        margin-top: 15px;
        font: normal normal 600 18px/28px Proxima Nova Regular;
        font-weight: bold;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    .tbl-partner tbody tr {
        width: 263px;
        height: 57px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        opacity: 1;
    }

    .tbl-partner li {
        width: 263px;
        height: 57px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #E5E5E5;
        border-radius: 8px;
        opacity: 1;
    }

    .tbl-partner tbody tr td {
        padding: 5px 0px 0px 10px;
        margin-bottom: 10px;
    }

    .tbl-partner tbody tr td:nth-child(2) {
        text-align: left;
        font: normal normal normal 14px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    .tbl-partner tbody tr td:nth-child(3) {
        font: normal normal normal 12px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #E9433D;
        opacity: 1;
    }

    .od-request {
        margin: 20px 0px;
        margin: 0 auto;
        width: 257px;
        height: 33px;
        background: #FFE1B5 0% 0% no-repeat padding-box;
        border-radius: 20px;
        opacity: 1;
    }

    .od-request p {
        float: right;
    }

    .od-request h5 {
        padding: 1px 0px 0px 18px;
        text-align: left;
        font: normal normal 600 14px/28px Proxima Nova Regular;
        letter-spacing: 0.5px;
        color: #F8A631;
        opacity: 1;
    }

    .tbl-partner {
        margin-bottom: 20px;
    }

    .delivery-disable {
        width: 231px;
        height: 46px;
        background: #eb5c58 0% 0% no-repeat padding-box;
        border-radius: 5px;
        opacity: 0.2;
        font: normal normal 600 12px/20px Proxima Nova Regular;
        letter-spacing: 0.2px;
        color: #FFFFFF;
        opacity: 1;
    }

    .come-from-modal.right.fade .modal-dialog {
        right: 0;
        /*left: 75%;*/
        top: 0%;
        width: 100%;
        max-width: 380px;
    }

    .export{
        margin-left: 770px;
        color: #F8A631;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #F8A631;
        border-radius: 5px;
        opacity: 1;
        width: 100px;
        height: 35px;
        position: relative;
        overflow: hidden;
        text-align: center;
        padding: 7px 10px;
    }

    .filter{
        /*margin-left: 770px;*/
        color: #F8A631;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border: 1px solid #F8A631;
        border-radius: 5px;
        opacity: 1;
        width: 100px;
        height: 35px;
        position: relative;
        overflow: hidden;
        text-align: center;
        padding: 7px 10px;
    }

    .filter:hover{
        color: #fff;
        background: #ffc642 0% 0% no-repeat padding-box;
    }

    @media screen and (min-width: 768px) {
        .modal-dialog {
            left: 0%;
            top: -10%;
        }
    }

    @media screen and (max-width: 1200px) {
        .come-from-modal.right.fade .modal-dialog {
            right: 0;
            left: 68%;
        }
    }

    #order_details button.close {
        padding: 0;
        cursor: pointer;
        background: transparent;
        border: 0;
        -webkit-appearance: none;
        margin-right: 10px;
    }

    #order_details button.close img {
        width: 25px;
        height: 25px;

    }

    #order_details .modal-title {
        text-align: left;
        font: normal normal 600 20px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    #order_details .modal-body .m-body {
        margin: 0;
        padding-top: 10px;
    }

    #order_details .pay-type {
        text-align: left;
        font: normal normal normal 12px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #969A9F;
        opacity: 1;
        margin-bottom: 0;
    }

    #order_details .pay-mode {
        font: normal normal 600 14px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    #order_details .modal-body .m-sell {
        margin: 0;
        padding: 10px 0px;
        background: #F4F4F4 0% 0% no-repeat padding-box;
        opacity: 1;
        height: max-content;
    }

    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    #order_details .col {
        padding: 10px;
    }

    #order_details .border-line {
        border-right: 1px solid #000;
    }

    #order_details .no-border {
        border-right: 1px solid #fff;
    }

    #order_details .sell-detail {
        text-align: left;
        font: normal normal 600 12px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
        margin-bottom: 2px;
    }

    #order_details .item-container {
        width: 95%;
        height: max-content;
        margin: 0px 10px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 1px 12px #00000029;
        border-radius: 5px;
        opacity: 1;
        padding: 10px;
    }

    #order_details .modal-header {
        /* border-bottom: 1px solid #e5e5e5;  */
        border: none;
    }

    .prod-name {
        text-align: left;
        font: normal normal normal 12px/15px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #262626;
        opacity: 1;
        font-weight: bold;
    }

    .prod-info {
        text-align: left;
        font: normal normal normal 10px/12px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #262626;
        opacity: 1;
    }

    .prod-price {
        text-align: left;
        font: normal normal bold 12px/15px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #E8413D;
        opacity: 1;
    }

    .prod-total {
        margin: 10px 10px;
        padding: 10px 0px;
        border-top: 1px solid #e5e5e5;
        border-bottom: 1px solid #e5e5e5;
    }

    .ord-id {
        text-align: left;
        font: normal normal 600 16px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
    }

    .order-details {
        width: 100%;
        border-bottom: 1px solid #e5e5e5;
        padding: 0px 10px;
    }

    .btn-complete {
        width: 72px;
        height: 24px;
        background: #53DE53 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.5;
        border: none;
    }

    .btn-complete span {
        text-align: left;
        font: normal normal normal 12px/22px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #368f36;
        opacity: 1;
    }

    .btn-failed {
        width: 72px;
        height: 24px;
        background: #ff623b 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.5;
        border: none;
    }

    .btn-failed span {
        text-align: left;
        font: normal normal normal 12px/22px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #6e4545;
        opacity: 1;
    }

    .btn-pending {
        width: 72px;
        height: 24px;
        background: #3455eb 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.5;
        border: none;
    }

    .btn-pending span {
        text-align: left;
        font: normal normal normal 12px/22px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #fff;
        opacity: 1;
    }

    .btn-progress {
        width: 90px;
        height: 24px;
        background: rgba(248, 166, 49, 0.3) 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.3;

        font: normal normal normal 10px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #EFA234;
        opacity: 1;
        border: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-success {
        width: 90px;
        height: 24px;
        background: rgba(62, 168, 62, 0.3) 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.3;

        font: normal normal normal 10px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #3EA83E;
        opacity: 1;
        border: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-success:hover
    {
        background: rgba(62, 168, 62, 0.3) 0% 0% no-repeat padding-box;
        color: #3EA83E;
    }

    .btn-success:focus
    {
        background: rgba(62, 168, 62, 0.3) 0% 0% no-repeat padding-box;
        color: #3EA83E;
    }

    .btn-approve {
        width: 90px;
        height: 24px;
        background: rgba(250, 97, 62, 0.3) 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.3;

        font: normal normal normal 10px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #ff0000;
        opacity: 1;
        border: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .btn-pickup {
        width: 90px;
        height: 24px;
        background: rgba(111, 179, 227, 0.3) 0% 0% no-repeat padding-box;
        border-radius: 14px;
        opacity: 0.3;

        font: normal normal normal 10px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #0048ff;
        opacity: 1;
        border: none;
        white-space: nowrap;
        cursor: pointer;
    }

    .txt-success {
        font: normal normal normal 13px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #3EA83E;
        opacity: 1;
    }
    .txt-failed {
        font: normal normal normal 13px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #ff0000;
        opacity: 1;
    }
    .txt-pending {
        font: normal normal normal 13px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #0048ff;
        opacity: 1;
    }

    #order_details .modal-content {
        overflow-x: hidden;
        height: 87vh;
        overflow-y: scroll;
    }

    #order thead tr th
    {
        white-space: nowrap;
    }

    #order tbody tr td
    {
        white-space: nowrap;
    }

    .btn-settings {
        width: 120px;
        height: 35px;
        background: rgba(248, 166, 49, 1) 0% 0% no-repeat padding-box;
        border-radius: 5px;
        border: none;

        font: normal normal 400 13px/20px Proxima Nova Regular;
        letter-spacing: 0.3px;
        color: #FFFFFF;
        opacity: 1;
    }

    .btn-settings:hover {
        background: rgba(248, 166, 49, 0.8) 0% 0% no-repeat padding-box;
    }

    .btn-secondary:not(:disabled):not(.disabled).active,
    .btn-secondary:not(:disabled):not(.disabled):active,
    .show>.btn-secondary.dropdown-toggle {
        background: rgba(248, 166, 49, 1) 0% 0% no-repeat padding-box;
    }

    .settings-popup {
        width: 246px;
        height: 125px;
        background: #FFFFFF 0% 0% no-repeat padding-box;
        box-shadow: 0px 0px 14px #7E7E7E29;
        border-radius: 5px;
        opacity: 1;
    }

    .dropdown-menu[x-placement^=bottom],
    .dropdown-menu[x-placement^=left],
    .dropdown-menu[x-placement^=right],
    .dropdown-menu[x-placement^=top] {
        right: auto;
        bottom: auto;
        margin-top: 10px;
    }

    .setting-head {
        width: 90%;
        height: 40px;
        background: #F5F5F5 0% 0% no-repeat padding-box;
        border-radius: 5px;
        opacity: 1;
        margin: 0 auto;
        margin-top: 3%;
        /* padding: 5% 5%; */
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0px 3%;

    }

    .txt-head-01 {
        font: normal normal 600 14px/20px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
        margin-bottom: 0;
    }

    .setting-item {
        list-style: none;
        padding-left: 0;
        width: 90%;
        margin: 0 auto;
    }

    .setting-item li {
        font: normal normal normal 12px/28px Proxima Nova Regular;
        letter-spacing: 0px;
        color: #2B2E32;
        opacity: 1;
        text-align: left;
        padding: 5px 5px;
        border-bottom: 1px solid #7E7E7E29;
        cursor: pointer;
    }

    .setting-item li:hover {
        background: rgba(248, 166, 49, 0.8) 0% 0% no-repeat padding-box;
    }

    .exportbtn{
        width: 100px;
        height: 35px;
        background: #FFFFFF 0% 0% no-repeat padding-box;border-radius: 5px;
        opacity: 1;
        color:orange;
        border:1px solid orange;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .exportbtn:hover{
        color: orange;
    }

</style>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<div class="content-wrapper">
   <div class="page-header">
      <h3 class="page-title"> Orders</h3>
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">SuperAdmin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders </li>
         </ol>
      </nav>
   </div>
   <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
         <div class="card">
            <div class="card-body table-responsive">

                <table>
                    <thead>
                        <tr>
                            <th>From</th>
                            <th>To</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <form method="post" class="modal-content" action="{{ route('orderfilter') }}" style="border: none;">
                            @csrf
                            <td>
                              <input type="date" id="from_date" name="from_date" class="form-control">
                            </td>
                            <td>
                                <input type="date" id="to_date" name="to_date" class="form-control">
                            </td>
                            <td>
                            
                                <button class="filter">Filter</button>
                            </td>
                            </form>
                            <td>
                                 <a href="javascript:" type="button" class="btn btn-warning"  style="float: left; position: relative; left: 10px;" onclick="location.href='{{url('superadmin/export_orders')}}'">Export</a>
                            </td>
                        </tr>
                    </tbody>
                </table>

               <table class="table table-striped" id="orders">
                  <thead>
                     <tr>
                        <th>S.No</th>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Store Name</th>
                        <th>Payment Type</th>
                        <th>Created Time</th>
                        <th>Delivery Man</th>
                        <th>Order Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>

                     @forelse($order_data as $key=>$slider)

                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$slider->order_id}}</td>
                        <td>{{$slider->customer}}</td>
                        <td>{{$slider->store_name}}</td>
                        <td>{{$slider->payment_type}}</td>
                        <td>{{date('d-m-Y h:i a', strtotime($slider->created_time))}}</td>
                        <td>
                            @if($slider->delivery_man == '')
                                <span style="color: red;">Please Assign Delivery Boy</span>
                            @else
                                 <button class="btn-success" style="color: red;">{{$slider->delivery_boy_name}}</button>
                            @endif
                        </td>

                        @if($slider->order_status == '')
                            <td><button class="btn-approve approve_check"  style="color: red;" data-id="{{$slider->order_main_id}}" data-toggle="modal" data-target="#approveOrReject">Approve Order</button></td>
                        @elseif($slider->order_status == 1)
                            <td><button class="btn-approve approve_check" style="color: red;" data-id="{{$slider->order_main_id}}" data-toggle="modal" data-target="#approveOrReject">{{$slider->order_status_name}}</button></td>
                        @elseif($slider->order_status == 2)
                            <td><button class=" btn-progress progress_check delivery_man_assign_check" style="color: orange;" data-id="{{$slider->order_main_id}}" data-toggle="modal" data-target="#Ready_for_Pickup">{{$slider->order_status_name}}</button></td>
                        @elseif($slider->order_status == 3)
                           <td><button class="btn-pickup out_for_delivery_check" data-id="{{$slider->order_main_id}}" data-toggle="modal" data-target="#out_for_delivery_order">{{$slider->order_status_name}}</button></td>
                        @elseif($slider->order_status == 7)
                            <td><button class="btn-approve complete_check" data-id="{{$slider->order_main_id}}" data-toggle="modal" style="color: brown;" data-target="#complete_order">{{$slider->order_status_name}}</button></td>
                        @elseif($slider->order_status == 4)
                            <td><button class="btn-success return_check" style="color: green;" data-id="{{$slider->order_main_id}}" data-toggle="modal" data-target="#return_order">{{$slider->order_status_name}}</button></td>
                        @elseif($slider->order_status == 5)
                            <td><button class="btn-approve">{{$slider->order_status_name}}</button></td>
                            <!-- <td><button class="btn-danger" style="color: red;">{{$slider->order_status_name}}</button></td> -->
                        @elseif($slider->order_status == 6)
                            <td><button class="btn-approve" style="color: black;">{{$slider->order_status_name}}</button></td>
                        @endif

                       
                        <td>
                          <a href="javascript:;" class="order_details_modal" data-id="{{$slider->order_id}}" data-storeid="{{$slider->store_id}}" data-toggle="modal" data-target="#view" title="view"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
                        </td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="7" class="text-center">
                           {{$message}}
                        </td>
                     <tr>
                     @endforelse
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>


<div id="approveOrReject" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Approve or Reject Order</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('approveOrder') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="approve_id" id="approve_id">
                       <!-- <input type="hidden" name="order_id" id="order_id"> -->
                        <label style="margin-left: 70px;">Approve or Reject Order</label><br>
                        <select class="form-control" name="order_status" id="order_status" style="margin-left: 70px;">
                            <option value="2">Approve</option>
                            <option value="5">Reject</option>
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="Ready_for_Pickup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Ready for Pickup</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('proceedOrder') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="progress_id" id="progress_id">
                       <!-- <input type="hidden" name="order_id" id="order_id"> -->
                        <label style="margin-left: 70px;">Ready for Pickup</label><br>
                        <select class="form-control" name="order_status" id="order_status" style="margin-left: 70px;">
                            <option value="3">Ready for Pickup</option>
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="Assign_Delivery_Man" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Ready for Pickup</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('checkDeliveryman') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="assign_delivery_man_id" id="assign_delivery_man_id">
                        <span>Please Check Delivery Man Assign</span>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="out_for_delivery_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Out for Delivery</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('outfordeliveryOrder') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="out_for_delivery_id" id="out_for_delivery_id">
                       <!-- <input type="hidden" name="order_id" id="order_id"> -->
                        <label style="margin-left: 70px;">Out for Delivery</label><br>
                        <select class="form-control" name="order_status" id="order_status" style="margin-left: 70px;">
                            <option value="7">Out for Delivery</option>
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="complete_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Complete</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('completeOrder') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="complete_id" id="complete_id">
                       <!-- <input type="hidden" name="order_id" id="order_id"> -->
                        <label style="margin-left: 70px;">Complete</label><br>
                        <select class="form-control" name="order_status" id="order_status" style="margin-left: 70px;">
                            <option value="4">Complete</option>
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="return_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Return</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('returnOrder') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="return_id" id="return_id">
                       <!-- <input type="hidden" name="order_id" id="order_id"> -->
                        <label style="margin-left: 70px;">Return</label><br>
                        <select class="form-control" name="order_status" id="order_status" style="margin-left: 70px;">
                            <option value="6">Return</option>
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deliveryMan" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Delivery Man</h4>
                </div>
                
                <div class="modal-body">
                    <form method="post" class="modal-content" action="{{ route('assignDeliveryman') }}" style="border: none;">
                    @csrf
                  <div class="row">
                  </div><br><br>
                  <div class="row">
                    <div class="col-lg-8">
                        <input type="hidden" name="delivery_man_id" id="delivery_man_id">
                        <input type="hidden" name="delivery_partner" id="delivery_partner">
                        <label style="margin-left: 70px;">Delivery Man</label><br>
                        <select class="form-control" name="delivery_partner" id="delivery_partner" style="margin-left: 70px;">
                            <option value="">Select Delivery Man</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->first_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br><br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Proceed</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="view" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog">
      <div class="modal-content" style="position: static;">
          <div class="modal-header row d-flex justify-content-between mx-1 mx-sm-3 mb-0 pb-0 border-0" style="padding-top: 50 !important;">
              <div class="tabs active" id="tab01">
                  <h6 class="font-weight-bold">Basic Details</h6>
              </div>
              <div class="tabs" id="tab02">
                  <h6 class="text-muted">Order Details</h6>
              </div>
              <div class="tabs" id="tab03">
                  <h6 class="text-muted">Invoice</h6>
              </div>
              <div class="tabs" id="tab04">
                  <h6 class="text-muted">Status</h6>
              </div>
          </div>
          <div class="line"></div>
          <div class="modal-body p-0">
              <fieldset class="show" id="tab011">
                  <div class="bg-light">
                      <h5 class="text-center mb-4 mt-0 pt-4"></h5>
                      <h6 class="px-4" id="order_id"></h6>
                      <h6 class="px-4" id="date"></h6><br>
                      <h5 class="px-3">Order By</h5>
                      <h6 class="px-5" id="customer_name"></h6>
                      <h6 class="px-5" id="customer_mobile_no"></h6>
                      <h6 class="px-5" id="customer_address"></h6><br>
                      <h5 class="px-3">Order For</h5>
                      <h6 class="px-5" id="customer_order_for"></h6><br>
                      <h5 class="px-3">Order To</h5>
                      <h6 class="px-5" id="store"></h6>
                      <h6 class="px-5" id="store_phone"></h6>
                      <h6 class="px-5" id="store_address"></h6>
                      <h5 class="px-3">Order Time And Date</h5>
                      <h6 class="px-5" id="delivery_time"></h6>
                      <h6 class="px-5" id="delivery_day"></h6>
                  </div>
                  <div class="form-group">
                  <label for="city_name">Care Givers</label>
                  <select name="city_id" type="text"  class="form-control name_city" id="caregivers">
                  <option value="">--- Select Care Giver---</option>
                  </select>
                  <input type="hidden" class="form-control"  id="order_deliveryboy_id">
                  <button type="submit" class="btn btn-primary waves-effect" onclick="assigndeliveryboy()" style="display: block;margin: 0 auto;">Assign Care Givers</button>
               </div>
              </fieldset>
              <fieldset id="tab021">
                  <div class="bg-light">
                      <h5 class="text-center mb-4 mt-0 pt-4">Order Details</h5>
                      <hr/>
                      <h6 id="order_details"></h6>
                      <hr/>
                      <h5 id="total_cart_price" style="margin-left: 245px;"></h5>
                  </div>
              </fieldset>
              <fieldset id="tab031">
                  <div class="bg-light">
                      <h5 class="text-center mb-4 mt-0 pt-4">Invoice</h5>
                      <hr/>
                      <h6 id="order_invoice"></h6>
                      <hr/>
                      <h5 id="total_cart_price_invoice" style="margin-left: 245px;"></h5>
                      <h5 style="margin-left: 245px;">Delivery Fees: ₹0</h5>
                      <h5 style="margin-left: 245px;">Tax: ₹0</h5>
                      <h5 id="payment_mode_invoice" style="margin-left: 245px;"></h5>
                  </div>
              </fieldset>
              <fieldset id="tab041">
                  <div class="bg-light">
                      <h5 class="text-center mb-4 mt-0 pt-4">Status</h5>
                      <h5 id="status_order_status" style="margin-left: 50px;"></h5>
                      <h5 id="status_order_updated" style="margin-left: 50px;"></h5>
                      <hr/>
                      <h5 id="status_order_updated_at" style="margin-left: 50px;"></h5>
                      <h5 id="status_order_created_at" style="margin-left: 50px;"></h5>
                  </div>
              </fieldset>
          </div>
          <div class="line"></div>
          <div class="modal-footer d-flex justify-content-center border-0">
              <a href="javascript:;" id="cancel_button" type="button" data-toggle="modal" data-target="#cancel_order" class="btn btn-danger btn-sm cancel_id">Cancel Orders</a>
              <button type="button" class="btn btn-default btn-sm btn-outline-danger" data-dismiss="modal">Cancel</button>
          </div>
      </div>
  </div>
</div>

<div id="cancel_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Cancel Order</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('cancelOrder') }}" style="border: none;">
                    @csrf
                     <input type="hidden" name="id" id="id">
                     <input type="hidden" name="user_id" id="loginuser" >
                     <input type="hidden" name="sd_id" id="sd_id" >
                     @foreach($cancel_reasons as $data)
                        <input type="radio" name="reason" value="{{$data->id}}"> {{$data->reason}} <br><br>
                     @endforeach
                     <br>
                        <textarea name="comment" class="form-control"></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="cancel_ind_order" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="custom-width-modalLabel">Cancel Order</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('cancelIndividualOrder') }}" style="border: none;">
                    @csrf
                     <input type="hidden" name="c_id" id="c_id">
                     <input type="hidden" name="user_id_c" id="loginuser_c" >
                     <input type="hidden" name="c_sd_id" id="c_sd_id" >
                     @foreach($cancel_reasons as $data)
                        <input type="radio" name="reason" value="{{$data->id}}"> {{$data->reason}} <br><br>
                     @endforeach
                     <br>
                        <textarea name="comment" class="form-control"></textarea>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger waves-effect">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

<script src="{{asset('public/js/jquery.min.js')}}"></script>
<script src="{{asset('public/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/js/dataTables.bootstrap4.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function(){
        $(".approve_check").click(function(){
            var id = $(this).attr('data-id');
            $('#approve_id').val(id); 
        });
    });

    $(document).ready(function(){
        $(".progress_check").click(function(){
            var id = $(this).attr('data-id');
            $('#progress_id').val(id); 
        });
    });

    $(document).ready(function(){
        $(".delivery_man_assign_check").click(function(){
            var id = $(this).attr('data-id');
            $('#assign_delivery_man_id').val(id); 
        });
    });

    $(document).ready(function(){
        $(".delivery_man_check").click(function(){
            var id = $(this).attr('data-id');
            $('#delivery_man_id').val(id); 
        });
    });

    $(document).ready(function(){
        $(".complete_check").click(function(){
            var id = $(this).attr('data-id');
            $('#complete_id').val(id); 
        });
    });

    $(document).ready(function(){
        $(".out_for_delivery_check").click(function(){
            var id = $(this).attr('data-id');
            $('#out_for_delivery_id').val(id); 
        });
    });

    $(document).ready(function(){
        $(".return_check").click(function(){
            var id = $(this).attr('data-id');
            $('#return_id').val(id); 
        });
    });

</script>

<script type="text/javascript">

    $(document).ready(function(){
        $(".delivery_partner").click(function(){
            var id = $(this).attr('data-id');
            $('#delivery_partner').val(id);
           // $('#delivery_man_id').val(id); 
        });
    });
    
</script>

<script type="text/javascript">

  $(document).ready(function(){
  
      function filter(from_date = '', to_date = '') {
        
            $.ajax({
                url:"{{ url('superadmin/filter_manage_orders')}}",
                method:"GET",
                data:{
                  from_date:from_date, to_date:to_date,
                },
                success:function(data) {
                  $('tbody').html(data);
                }
            });   
        }
        
          $('.filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
              filter(from_date, to_date);
        });
    });

  $(document).ready(function(){
    $('.order_details_modal').click(function(){
                var order_id ="";
        order_id = $(this).attr('data-id');
        store_id = $(this).attr('data-storeid');
        $.ajax({
            url: "{{url('superadmin/view_order_store')}}" + '/' + order_id + '/' + store_id,
            type: 'GET',
            dataType: 'json',
        }).done(function(response) {
            $('#loginuser').val(response.user.id);
            $('#loginuser_c').val(response.user.id);
            $('#sd_id').val(response.basic_details.store_id);
            $('#c_sd_id').val(response.basic_details.store_id);
            $('#order_id').html('Order ID: #' + response.basic_details.order_id);
            $('#date').html(response.basic_details.date);
            $('#customer_name').html(response.basic_details.customer);
            $('#customer_mobile_no').html(response.basic_details.phone_no);
            $('#customer_address').html(response.basic_details.address + ',' + response.basic_details.landmark);
            $('#customer_order_for').html(response.basic_details.customer + '(' + response.basic_details.mobile_no + ')');
            $('#store').html(response.basic_details.sd_sname);
            $('#store_phone').html(response.basic_details.sd_snumber);
            $('#store_address').html(response.basic_details.sd_address + '-' + response.basic_details.sd_spincode);
            $('#delivery_time').html(response.basic_details.delivery_time);
            $('#delivery_day').html(response.basic_details.delivery_day);
            document.getElementById("order_deliveryboy_id").value=order_id;
            $("#order_details").empty();
            $("#order_invoice").empty();
            $.each(response.order_details,function(key,value){
              $("#order_details").append('<h6 class="px-5"><a href="javascript:;" class="cancel_ind_order" data-id="'+value.main_id+'" data-toggle="modal" data-target="#cancel_ind_order" title="cancel"><i class="fa fa-times" style="color: red"></i></a> &nbsp;&nbsp;'+ value.product+ '('+ value.measurement +') &nbsp;&nbsp; x'+ value.quan + '&nbsp;&nbsp;&nbsp;&nbsp; ₹'+ value.tot +'</h6>');

              $("#order_invoice").append('<h6 class="px-5">&nbsp;&nbsp;'+ value.product+ '('+ value.measurement +') &nbsp;&nbsp; x'+ value.quan + '&nbsp;&nbsp;&nbsp;&nbsp; ₹'+ value.tot +'</h6>');
            });

            $(document).ready(function(){
                $(".cancel_ind_order").click(function(){
                    var id = $(this).attr('data-id');
                    $('#c_id').val(id); 
                });
            });

            $('#total_cart_price').html('Total Cart Price: ₹' + response.total_cart);
            $('#total_cart_price_invoice').html('Total Cart Price: ₹' + response.total_cart);
            $('#payment_mode_invoice').html('Payment Mode: ' + response.basic_details.payment_type);
            $('#status_order_updated_at').html('Order Updated : ' + response.basic_details.updated_at);   
            $('#status_order_created_at').html('Order Created : ' + response.basic_details.created_at);
            $('#status_order_status').html('Order Status : ' + response.basic_details.order_status_name);
            $('#status_order_updated').html('Order Updated By: ' + response.basic_details.canceled_user);
            $('#cancel_button').attr("data-id",response.basic_details.order_id);
            $('#caregivers').empty();
            var sel = document.getElementById('caregivers');
            $.each(response.delivery_boy_select, function (index, item) {
                      console.log('delivery_boy_select',item);
                     //   $(name).get(0).options[$(name).get(0).options.length] = new Option(item.area_name, item.area_name);
                     opt = document.createElement('option');
                     opt.value = item.id;
                    opt.innerHTML = item.first_name;
                    sel.appendChild(opt);
                    });

        });
    });
  });

   $(function () {
    $.noConflict();
        $('#orders').DataTable({
            "pageLength": 10,
            "bSort": true,
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": true,
        });        
    });

    $(document).ready(function(){
        $(".cancel_id").click(function(){
            var id = $(this).attr('data-id');
            $('#id').val(id); 
        });
    });

    $(document).ready(function(){

      $(".tabs").click(function(){

        $(".tabs").removeClass("active");
        $(".tabs h6").removeClass("font-weight-bold");
        $(".tabs h6").addClass("text-muted");
        $(this).children("h6").removeClass("text-muted");
        $(this).children("h6").addClass("font-weight-bold");
        $(this).addClass("active");

        current_fs = $(".active");

        next_fs = $(this).attr('id');
        next_fs = "#" + next_fs + "1";

        $("fieldset").removeClass("show");
        $(next_fs).addClass("show");

        current_fs.animate({}, {
          step: function() {
            current_fs.css({
              'display': 'none',
              'position': 'relative'
            });
            next_fs.css({
              'display': 'block'
            });
          }
        });
      });
    });

    function assigndeliveryboy(){
        $.ajax({
                type: "GET",
                url:"{{ url('superadmin/delivery_city/assigncaregiver') }}",
                data:{'id':document.getElementById("caregivers").value,'order_id':document.getElementById("order_deliveryboy_id").value},
                dataType: "json",
                success: function (response) {
                    alert("Care Giver Assigned Successfully ");
                    location.reload();
                },
                failure: function (msg) {
                    alert("No records to display ");
                }
            });
    }

</script>