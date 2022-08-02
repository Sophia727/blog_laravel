@extends('template.admin')
@section('title', "Manage Articles")

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
            <a href="{{route("articles.create")}}" class="btn btn-sm btn-outline-secondary ">
              <i class="bi bi-plus-circle"></i>
                New Article
            </a>
          </div>
        </div>
    
       
        <div class="card text-left w-50 mx-auto shadow">
        @if ($article->photo)
        @if (Str::contains($article->photo, 'https://'))
            <img class="card-img-top" src="{{$article->photo}}" alt="{{$article->title}}" width="100px">
            @else
            <img class="card-img-top" src="{{asset('storage/'.$article->photo)}}" alt="{{$article->title}}" width="100px">
            
        @endif
        @else
            <img class="card-img-top" src="{{asset('storage/image/default-image.jpg')}}" alt="{{$article->title}}" width="100px">        
        @endif
        <div class="card-body p-2">
            <h4 class="card-title">{{$article->title}}</h4>
            <p class="card-text">
                {{$article->description}}
            </p>
            <p>
                <strong>Published </strong> <input type="checkbox" @if ($article->published)
                checked
            @endif>
        </p>
      </div>
    </div>
</main>
@endsection
           