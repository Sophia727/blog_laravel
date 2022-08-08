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
          @include('components.search')
        </div>

      </div>

      <div class="card-body">
       
        <div class="table-responsive table-bordered">
          <table class="table  table-sm">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Author</th>
                <th scope="col">Publish Date</th>
                <th scope="col">Published</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($articles as $article)
          
            <tr>
              <td>{{$article->id}}</td>
              <td>
                @if($article->photo)
                  @if(Str::contains($article->photo, 'https://'))
                    <img src="{{$article->photo}}" alt="{{$article->title}}" width="100px"></td>
                    @else
                    <img src="{{asset('storage/'.$article->photo)}}" alt="{{$article->title}}" width="100px">
                  @endif
                  @else
                  <img src="{{asset('storage/images/default-image.jpg'.$article->photo)}}"alt="{{$article->title}}" width="100px">
                  
                @endif 
              </td> 
              <td>{{$article->title}}</td>
              <td>{{ Str::limit($article->description,'30') }}</td>
              <td>{{$article->author_id}}</td>
              <td>{{$article->publication_date}}</td>
              <td>{{$article->published}}</td>

              <td>
                <div class="form-check form-switch">
                  <input class="form-check-input" onchange="if(confirm('Are you sure you would like to change the status of this Article?')){
                    document.getElementById('publish-{{$article->id}}').submit();
                    }" type="checkbox" @if ($article->published)
                    checked
                    @endif name="published" role="switch" id="published">

                </div>
                <form id="publish-{{$article->id}}" action="{{route('articles.publish', ['id'=>$article->id])}}" method="post">
                  @csrf
                  @method('put')
                </form>
              </td>

                                                                                                                                                                                
              
              <td>
                {{-- Read more --}}
                <a href="{{route('articles.show', ['article'=>$article->id])}}" title="Read more" class="btn btn-secondary btn-sm"><i class="bi bi-binoculars"></i></a>
            
                {{-- edit --}}
                <a href="{{route('articles.edit', ['article'=>$article->id])}}" class="btn btn-success btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
              {{-- we renamed button into a becausse we're using a get method with delete --}}
            
              {{-- delete --}}
                {{-- javascript --}}
                <button onclick="if(confirm('Are you sure you want to delete this post?')){
                  document.getElementById('form-{{$article->id}}').submit();
                }"
                class="btn btn-danger btn-sm" title="Delete"><i class="bi bi-trash"></i></button>
                <form id="form-{{$article->id}}" action="{{route('articles.destroy', ['article'=>$article->id])}}" method="post">
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
        {{$articles->links()}}
    </div>
    
</main>
@endsection