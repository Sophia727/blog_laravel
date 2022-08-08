@extends('template.user')
@section('title', "Add Article: User view")

@section("content")
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Articles</h1>
      <div class="btn-toolbar mb-2 mb-md-0">

        <a  href="{{route("userArticlesList")}}" class="btn btn-sm btn-outline-secondary ">
          
            <i class="bi bi-list-ul"></i>
            Article List
        </a>
      </div>
    </div>

    @if(session('error'))
      <div class="alert alert-danger">
        {{session('error')}}
      </div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Write a new Article</h4>
      </div>
      <div class="card-body">
          <form action="{{route('userArticle.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row my-2">
              <div class="col">
                <div class="form-group">
                  <input type="text" class="form-control @error('title')is-invalid @enderror" name="title" placeholder="Post Title" value="{{old('title')}}" >
                  @error('title')
                    <div class="alert alert-danger">
                    {{$message}} 
                    </div>
                  @enderror
                </div>
              </div>
            </div>

            <div class="row my-2">
              <div class="col">
                <div class="form-group ">
                  <textarea name="description" class="form-control" placeholder="Description of the post" cols="30" rows="10">{{old('description')}}</textarea>
                </div>
                @error('description')
                  <div class="alert alert-danger">
                    {{$message}}
                  </div>
                @enderror
              </div>
            </div>

            <div class="row my-2">
              <div class="col">
                <div class="form-group">
                  <input type="file" class="form-control" name="photo" id="title" placeholder="Post image" value="{{old('photo')}}" >
                  @error('photo')
                    <div class="alert alert-danger">
                      {{$message}}
                    </div>
                  @enderror
                </div>
              </div>
            </div>
            <button class="btn btn-md btn-primary"> <i class="bi bi-plus-circle"></i> Save</button>
          </form>
      
        </div>
      </div>
  </main>
  @endsection