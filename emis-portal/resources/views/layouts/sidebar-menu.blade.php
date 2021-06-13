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
        <li class="nav-item">
            <router-link to="/admission_transfer_index" class="nav-link">
                <i class="fa fa-users nav-icon blue"></i>
                <p>Admission</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/admissionRequest" class="nav-link">
                <i class="fa fa-users nav-icon blue"></i>
                <p> Request for admission</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/track_application" class="nav-link">
            <i class="fa fa-search nav-icon blue"></i>
              <p> Track application</p>
            </router-link>
        </li>
        <li class="nav-item">
            <a href="#" onclick="logout()" class="dropdown-item">
                <i class="fa fa-sign-out-alt pr-4"></i>Sign out
            </a>
        </li>
    </ul>
  </nav>
  <script>
    function logout(){
      Swal.fire({
        title: 'Are you sure you wish to signout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes!',
        }).then((result) => {
        if (result.isConfirmed) {
          window.location="user_logout";
        }
      });
    }
</script>
