<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt blue"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li>
      @can('isAdmin')
      <!-- <li class="nav-item">
        <router-link to="/Userprofile" class="nav-link">
          <i class="nav-icon fas fa-list orange"></i>
          <p>
            Profile
          </p>
        </router-link>
      </li> -->
      <li class="nav-item">
            <router-link to="/admission" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
              <p>
              Admission
              </p>
            </router-link>
          </li>

      @endcan

      <!-- @can('isAdmin')
        <li class="nav-item">
          <router-link to="/result" class="nav-link">
            <i class="fa fa-users nav-icon orange"></i>
            <p>Result</p>
          </router-link>
        </li> -->

      <li class="nav-item">
            <router-link to="/track_application" class="nav-link">
            <i class="fa fa-search nav-icon blue"></i>
              <p>
              Track application
              </p>
            </router-link>
          </li>

      @endcan

      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>