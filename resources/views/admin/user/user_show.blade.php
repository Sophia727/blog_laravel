@extends('template.admin')
@section('title', "Users List")

@section('content')   
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Articles</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <a href="{{route("user.create")}}" class="btn btn-sm btn-outline-secondary ">
            <i class="bi bi-plus-circle"></i>
              New User
        </a>
      </div>
    </div>
    <div class="card w-50 mx-auto shadow">
        <div class="card">
            <h5 class="card-header">{{$user->name}}</h5>
            <div class="card-body">
          
                @if($user->photo)
                @if(Str::contains($user->photo, 'https://'))
                  <img src="{{$user->photo}}" alt="{{$user->title}}" width="100px"></td>
                  @else
                  <img src="{{asset('storage/'.$user->photo)}}" alt="{{$user->name}}" width="100px">
                @endif
                @else
                    <img src="{{asset('storage/images/profile-default.jpg'.$user->photo)}}" alt="{{$user->name}}" width="100px">
                
                @endif 
                
                <div class="card-body">
                <h6 class="card-title">User Id:{{$user->id}}</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">User role: {{$user->role}}</li>
                <li class="list-group-item">Email: {{$user->email}}</li>
                <li class="list-group-item">Birthdate: {{$user->birth_date}}</li>
                <li class="list-group-item">Account created on : {{$user->created_at}}</li>
                </ul>
            
        <div class="card-body">
            <p>
                <strong>Account status: Active </strong> <input type="checkbox" @if ($user->activate)
                checked
            @endif>
        </p>
         afficher tous les articles reliés à cet utilisateur
      </div>
       
         
      </div>
    </div>
</main>
@endsection
           