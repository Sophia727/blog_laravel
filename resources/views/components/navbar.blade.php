{{-- <'show'=>'user.show',nav class="navbar navbar-expand-lg bg-dark"> --}}
  <nav class="navbar navbar-dark navbar-expand-lg bg-dark">

  <div class="container-fluid">
      <a class="navbar-brand" href="#">Blog FS-08</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          @auth
            <li class="nav-item">
              <a class="nav-link" href="{{route('articles.list')}}">Articles</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/admin">Dashbord</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link btn btn-danger" href="/logout">Log-out</a>
            </li>   
          @endauth
          {{-- @auth('user')
            <li class="nav-item">
              <a class="nav-link" href="{{route('user_articles_list')}}">Articles</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="/admin">Dashbord</a>
            </li> 
            <li class="nav-item">
              <a class="nav-link btn btn-danger" href="/logout">Log-out</a>
            </li>   
          @endauth --}}
          @guest
            <li class="nav-item">
              <a class="nav-link" href="login">Login</a>
            </li>  
          @endguest 
          
        </ul>
      </div>
    </div>
  </nav>
  <div class="background-head">
<span></span>
  </div>