@extends('template.admin')
@section('title', "Users List")

@section('content')   
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Users</h1>
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
    @if(session('status'))
      <div class="alert alert--success">
        {{session('status')}}
      </div>
    @endif
    <div class="card ">

      <div class="card-header"> 
        
        <div class="col-8">
          <h2>All Users</h2></div>
        </div>

        <div class="col-4">
          @include('components.searchUser')
        </div>

      </div>

      <div class="card-body">
       
        <div class="table-responsive table-bordered">
          <table class="table  table-sm">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Photo</th>
                <th scope="col">Role</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Birthdate</th>
                <th scope="col">Created on</th>
                <th scope="col">Activated</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
          
            <tr>
              <td>{{$user->id}}</td>
              <td>
                @if($user->photo)
                  @if(Str::contains($user->photo, 'https://'))
                    <img src="{{$user->photo}}" alt="{{$user->title}}" width="100px"></td>
                    @else
                    <img src="{{asset('storage/'.$user->photo)}}" alt="{{$user->name}}" width="100px">
                  @endif
                  @else
                  <img src="{{asset('storage/images/profile-default.jpg'.$user->photo)}}" alt="{{$user->name}}" width="100px">
                  
                @endif 
              </td> 
              <td>{{$user->role}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->birth_date}}</td>
              <td>{{$user->created_at}}</td>
        
              <td>
                {{-- activate --}}
                 <div class="form-check form-switch">
                    <input class="form-check-input" onchange="if(confirm('Are you sure to change the state of this user?')){
                      document.getElementById('activate-{{$user->id}}').submit();
                      }" type="checkbox" @if ($user->activate)
                        checked
                      @endif name="activate"  role="switch" id="activate">
                  </div>
                  <form id="activate-{{$user->id}}" action="{{route('users.activate',['id'=>$user->id])}}" method="post">
                    @csrf
                    @method('put')
                  </form>
              </td>

                                                                                                                                                                                
              
              <td>
            {{-- Read more --}}
                <a href="{{route('users.show', ['user'=>$user->id])}}" title="Read more" class="btn btn-secondary btn-sm"><i class="bi bi-binoculars"></i></a>
 
            {{-- delete --}}
                {{-- javascript --}}
                <button onclick="if(confirm('Are you sure you want to delete this User?')){
                  document.getElementById('user-{{$user->id}}').submit();
                }"
                class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                <form id="user-{{$user->id}}" action="{{route('users.destroy', ['user'=>$user->id])}}" method="post">
                  @csrf
                  @method('delete')
                </form>
              </td>
            </tr>
            @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer">
        {{$users->links()}}
    </div>
    
</main>
@endsection