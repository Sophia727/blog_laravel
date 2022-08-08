@extends('template.user')
@section('title', "Articles: user view")

@section('content')   
<main class="col-md-9 m-auto col-lg-10 w-100">
    <div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <div class="head-background">
        <span></span>
      </div>
      <h1 class="h2">Articles</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
          <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
          <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <a href="{{route("userArticle.create")}}" class="btn btn-sm btn-outline-secondary ">
            <i class="bi bi-plus-circle"></i>
              New Article
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
          <h2>All articles</h2></div>
        </div>

        <div class="col-4">
          @include('components.userSearch')
        </div>

      </div>

      <div class="card-body">
       

        @foreach($articles as $article)
        <div class="user-article-view">
          <div class="card" style="width: 20rem;">
            @if($article->photo)
            @if(Str::contains($article->photo, 'https://'))
              <img src="{{$article->photo}}" alt="image" width="100px"></td>
              @else
              <img src="{{asset('storage/'.$article->photo)}}" alt="{{$article->name}}" width="100px">
            @endif
            @else
            <img src="{{asset('storage/images/default-image.jpg'.$article->photo)}}" alt="pic" width="100px">
            
          @endif 
          <div class="card-body">
            <h5 class="card-title">{{$article->title}}</h5>
            <p class="card-text">{{Str::limit($article->description, 100)}}</p>
            <a href="{{route('userArticleShow', $article->id )}}" class="btn btn-primary">Read more</a>
          </div>
          </div>
        </div>

        
        @endforeach

      </div>
      <div class="card-footer">
        {{$articles ?? '' ?? ''->links()}}
    </div>
    
</main>
@endsection