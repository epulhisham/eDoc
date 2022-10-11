<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" aria-current="page" href="/profile">
            <span data-feather="user" class="align-text-bottom"></span>
            My Profile
          </a>
          <a class="nav-link {{ Request::is('mainpage/folders') ? 'active' : '' }}" aria-current="page" href="/mainpage/folders">
            <span data-feather="folder" class="align-text-bottom"></span>
            Folder
          </a>
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="bar-chart-2" class="align-text-bottom"></span>
            Dashboard
          </a>
          <form action="/logout" method="post">
            @csrf
            <button type="submit" class="nav-link px-3 border-0"><span data-feather="log-out" class="align-text-bottom"></span> Logout</button>
        </form>
        </li>
      </ul>
    </div>
</nav> 