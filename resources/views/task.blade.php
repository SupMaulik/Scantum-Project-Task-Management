@extends('layouts.content')
@section('content-header')
@include("navbar") 
@include('add_task')
@php


if(isset($view)) //Start-> code to open View Task form model
{
  
           
                echo'
               <script type="text/javascript">
                window.onload = function () {
                OpenBootstrapPopup();
                };
                function OpenBootstrapPopup() {
                $("#view_model").modal("show");
                }
                </script>';
}//End-> code to open View Task form model

if(isset($task1) and !isset($view)) //Start-> code to open Edit Task form model
{
  
           
                echo'
               <script type="text/javascript">
                window.onload = function () {
                OpenBootstrapPopup();
                };
                function OpenBootstrapPopup() {
                $("#modal-2").modal("show");
                }
                </script>';
}//End-> code to open Edit Task form model


if(session()->has('id1')) //Start-> code to open Add Task form model
{
           
           
                echo'
                <script type="text/javascript">
                window.onload = function () {
                OpenBootstrapPopup();
                };
                function OpenBootstrapPopup() {
                $("#modal-1").modal("show");
                }
                </script>';

                session()->forget('id1');

}  //End-> code to open Add Task form model



if(isset($status)) //Start-> code to open Delete Task form model
{
           
           
                echo'
                <script type="text/javascript">
                window.onload = function () {
                OpenBootstrapPopup();
                };
                function OpenBootstrapPopup() {
                $("#delete_model").modal("show");
                }
                </script>';

                
}  //End-> code to open Delete Task form model    
@endphp

<div class="container">
      <div class="row">
      <div class="col-lg-12">
       
      

        <button style="float:right" class="btn btn-outline-info border rounded-pill border-primary float-end  mb-5 mt-5" type="button" data-bs-target="#modal-1" data-bs-toggle="modal" style="font-family: Play, sans-serif;margin-top: 2px;"><i class="far fa-plus-square" style="margin-right: 10px;"></i>Add Task</button>
       <!--table for CRUD View -->
			<table class="table table-hover" id="myTable">
			  <thead>
				<tr>
				  <th scope="col" class="text-center">#</th>
				  <th scope="col">Task name</th>
				  <th scope="col">Status</th>
				  <th scope="col">Time Stemp</th>
				  <th scope="col">Action</th>
				</tr>
			  </thead>
			  <tbody>
                 
                @if(isset($task))
                   
                @php
                $i=1
                @endphp
                @foreach($task as $item)
				<tr id="1" >
				  <td class="index">{{$i}}</td>
				  <td class="indexInput">{{$item->Task_Name}}</td>
				  <td>{{$item->Task_Status}}</td>
				  <td>{{$item->created_at}}</td>
				  <td> <a href="{{url('/edit_task/')}}/{{$item->id}}" type="button"  class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
          <a href="{{url('/view_task/')}}/{{$item->id}}" type="button"  class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></a> 
          <a href="{{url('delete_task/')}}/{{$item->id}}" class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a></td>
				</tr>
                @php
                $i++
                @endphp
                @endforeach
                @endif
				
			  </tbody>
			</table>
      <!--table for CRUD View -->
        </div>
      </div>
    </div>
    


@endsection