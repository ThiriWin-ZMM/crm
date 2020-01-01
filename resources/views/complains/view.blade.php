@extends('layouts/app')

@section('content')
<div class="container">

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link @if($status=='all')active @endif" href="{{url('/complains')}}">
                All Complains
                <span class="badge badge-secondary">
                    {{$count_all}}
                </span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($status==='0')active @endif" href="{{url('/complains/filter/0')}}">
                New
                <span class="badge badge-danger">
                    {{$count_new}}
                </span>
            </a>
        </li>       
        <li class="nav-item">
            <a href="#" class="dropdown-toggle nav-link @if($status>0)active @endif" data-toggle="dropdown">
                Filter
            </a>
            <div class="dropdown-menu">
            <a href="{{url('/complains/filter/1')}}" class="dropdown-item">
                Assigned
            </a>
            <a href="{{url('/complains/filter/2')}}" class="dropdown-item">
                WIP
            </a>
            <a href="{{url('/complains/filter/3')}}" class="dropdown-item">
                Done
            </a>
            <a href="{{url('/complains/filter/4')}}" class="dropdown-item">
                Closed
            </a>                                            
            </div>                           
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{url('/complains/add')}}">
                <i class="fa fa-plus-circle"> Add Complain </i>
            </a>            
        </li>
    </ul>

    <br>


<div class="row">
    <div class="col-md-8">
        <div class="card-bg {{config('crm.badge')[$complain->status]}} 
            @if ($complain->status !=1 ) text-light @endif">
            <div class="card-header">
                <i class="fa-fa-exclamation-circle"></i><b>{{$complain->subject}}</b>               
            </div>
            <div class="card-body">
                {{$complain->detail}}
            </div>
            <div class="card-footer">
                <small>{{$complain->created_at->diffForHumans()}}</small>
            </div>

            <div class="float-right">
                <a href="{{url('complains/edit/'.$complain->id)}}" class="btn btn-light">Edit</a>
                <a href="{{url('complains/delete/'.$complain->id)}}" class="btn btn-danger text-light"><i class="fa fa-trash"></i></a>           
            </div>

        </div>

        <br>

        <h5><i class="fa fa-comments"></i> Comments ({{count($complain->comments)}}) </h5>
        @if(count($complain->comments)>0)
        @foreach($complain->comments as $comment)       
        <div class="card">
            <div class="card-body">
                {{$comment->comment}}               
            </div>
            <div class="card-footer">
                <small>{{$comment->created_at->diffForHumans()}}</small>                
            </div>          
        </div>
        @endforeach
        @endif

        <div>
            <form action="{{url('comments/add')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="complain_id" value="{{$complain->id}}">
                <textarea name="comment" class="form-control" placeholder="Enter your comment"></textarea>  
                <br>
                <input type="submit" name="Add Comment" value="Add Comment" class="btn btn-secondary">
            </form> 
            <br>
            <br>        
        </div>
    </div>


    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <div class="dropdown">
                Status: <b class="dropdown-toggle" data-toggle="dropdown">{{config('crm.status')[$complain->status]}}</b> 
                <div class="dropdown-menu">
                    @foreach(config('crm.status') as $index => $status)
                    <a href="{{url("complains/status/$complain->id/$index")}}" class="dropdown-item">
                    {{$status}}
                    </a>
                    @endforeach
                    
                </div>
                </div>         
            </div>
            <div class="card-body">
                <div class="dropdown">
                  Assigned To : 
                  <span class="dropdown-toggle" data-toggle="dropdown">
                    {{$complain->user->name}}
                    ({{config('crm.role')[$complain->user->role] }})                      
                  </span>
                  <div class="dropdown-menu">
                    @foreach($users as $user)
                    <a href="{{url("complains/assign/$complain->id/$user->id")}}" class="dropdown-item">
                        {{$user->name}}
                    </a>
                    @endforeach                      
                  </div>
                  
                </div>
            </div>
        </div>
        <div class="card-body">
            Email: {{$complain->customer->email}},<br>
            Phone: {{$complain->customer->Phone}}
        </div>
        <div class="card-footer">
            <small>{{$complain->customer->address}}</small>         
        </div>

        <br>

        <div class="card">
            <div class="card-header">
                <i class="fa fa-mobile-alt"></i>Product
                
            </div>
            <div class="card-body">
                Name : {{$complain->product->name}}
            </div>
            <div class="card-footer">
                <small>{{$complain->product->brand}},{{$complain->product->model}}</small>
            </div>
        </div>  
        <br>
        <div class="card">
            <div class="card-body">
                <ul class="text-muted">
                    @foreach($complain->logs as $log)                    
                    <li>
                        <small>
                        {{$log->user->name}}
                        {{$log->action}},
                        {{$log->created_at->diffForHumans()}}
                        </small>
                    </li>
                    @endforeach
                
                </ul>
                
            </div>
            
        </div>    
    </div>
</div>
</div>
@endsection