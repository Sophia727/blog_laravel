<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          {{-- <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}"> --}}
            <a class="nav-link active" aria-current="page" href="#">
              <i class="bi bi-house-door fs-3"></i>            
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('articles.list')}}">
            <i class="bi bi-file-earmark fs-3"></i></i>            
            Articles
          </a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="{{route('user_list')}}">
            <i class="bi bi-people fs-3"></i>            Users
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('user_list')}}">
            <i class="bi bi-chat fs-3"></i>
            Comments
          </a>
        </li>
      </ul>


    </div>
  </nav>