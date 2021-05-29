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
      <li class="nav-item">
        <router-link to="/Userprofile" class="nav-link">
          <i class="nav-icon fas fa-list orange"></i>
          <p>
            Profile
          </p>
        </router-link>
      </li>
      <li class="nav-item">
            <router-link to="/admission" class="nav-link">
            <i class="fa fa-users nav-icon blue"></i>
              <p>
              Admission
              </p>
            </router-link>
          </li>
      <!-- <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
        <i class="fa fa-users nav-icon blue"></i>
          <p>
            Admissions
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/enrolled_student" class="nav-link">
            <i class="fa fa-users nav-icon white"></i>
              <p>
              Enrolled in School
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/notenrolled_student" class="nav-link">
            <i class="fa fa-users nav-icon white"></i>
              <p>
               Not Enrolled in School
              </p>
            </router-link>
          </li>
          
          <li class="nav-item">
            <router-link to="/classxi_student" class="nav-link">
            <i class="fa fa-users nav-icon white"></i>
              <p>
               Class XI Admissions
              </p>
            </router-link>
          </li>
        </ul>
      </li> -->

      @endcan

      @can('isAdmin')
        <li class="nav-item">
          <router-link to="/result" class="nav-link">
            <i class="fa fa-users nav-icon orange"></i>
            <p>Result</p>
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