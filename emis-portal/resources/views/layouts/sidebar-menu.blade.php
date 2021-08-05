<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/userprofile" class="nav-link">
                <i class="fa fa-user nav-icon"></i>
                <p>Profile</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/chage_password" class="nav-link">
                <i class="fa fa-lock nav-icon"></i>
                <p>Change Password</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/new_admission_page" class="nav-link">
                {{--  admission_transfer_index --}}
                <i class="fa fa-users nav-icon"></i>
                <p>Registration Details</p>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link to="/admission_initiated" class="nav-link">
            <i class="fa fa-save nav-icon"></i>
            <p> Apply to Schools</p>
            </router-link>
        </li>
        @if(session('User_details')->user_type!=null && session('User_details')->user_type=='Parent')

        @endif
        @if(session('User_details')->user_type!=null && session('User_details')->user_type!='Parent')
            <li class="nav-item">
                <router-link to="/admissionRequest" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p> Request for admission</p>
                </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/track_application" class="nav-link">
                    <i class="fa fa-search nav-icon"></i>
                    <p> Track application</p>
                </router-link>
            </li>
        @endif
        <li class="nav-item">
            <a href="#" onclick="logout()" class="dropdown-item">
                <i class="fa fa-sign-out-alt pr-4"></i>Sign out
            </a>
        </li>
    </ul>
</nav>

