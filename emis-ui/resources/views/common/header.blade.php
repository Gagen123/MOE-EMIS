<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-image: url('img/bg_2.jpg')">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    @if(session('User_Details')['acess_level']=='Org' && session('org_profile')!=null)
      <div class="form-inline">
        @if(session('org_profile')->logo_path!='')
          <img src="storage/{{session('org_profile')->logo_path}}" onerror="this.src='img/question.PNG'" class="brand-image elevation-5 img-sm ml-4 img-circle" style="opacity: .8">
        @endif
        <span class="brand-text font-weight-light text-white ml-4">{{ session('org_profile')->orgName }}</span>
      </div>
    @endif

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link text-white" data-toggle="dropdown" href="#">
              <i class="fas fa-bell"></i>
               <span class="badge badge-warning navbar-badge bg-danger mr-3"><span id="notificationcount"></span> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    <span id="n_details"></span>
                </span>
            </div>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="user-panel d-flex">
                <div class="image">
                    <img src="img/user.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info text-white">
                  @if(session('User_Details')!=null)
                    {{ session('User_Details')['Full_Name'] }}
                  @endif
                </div>
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
            <router-link to="/profile" class="nav-link nav-sidebar">
              <i class="fas fa-user pr-4"></i>
              Profile
            </router-link>
          <div class="dropdown-divider"></div>
            <router-link to="/chage_passwprd" class="nav-link nav-sidebar">
              <i class="fa fa-lock-open pr-4"></i>Change Password
            </router-link>
          <div class="dropdown-divider"></div>
          <a href="#" onclick="logout()" class="dropdown-item nav-sidebar">
              <i class="fa fa-sign-out-alt pr-4"></i>Sign out
          </a>
        </div>
    </li>
  </ul>
  </nav>
