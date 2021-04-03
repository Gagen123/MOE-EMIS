<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" id="mainmenu" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="dashboard" class="nav-link pt-1 pb-1">
                    <i class=" nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p> 
                </a>
            </li>
            @if(session('User_Details')!=null)
            @foreach (session('User_Details')['modules'] as $mod)
                @if($mod['module_route']!=null || $mod['module_route']!="")
                <li class="nav-item" >
                    <router-link id="{{$mod['module_route']}}" :to="{ name: '{{ $mod['module_route']}}', query: {data:'{{ $mod['mod_id'] }}' } }" class="nav-link" onclick="afterclick()">
                        <i class=" nav-icon {{ $mod['module_icon']}}"></i>
                        <p>{{$mod['mod_name']}} </p>
                    </router-link>
                </li>
                @else
                <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas {{ $mod['module_icon']}}"></i>
                    <p>{{$mod['mod_name']}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (sizeof(session('User_Details')['sub_modules'])>0)
                    @foreach(session('User_Details')['sub_modules'] as $sub_mod)
                        @if($sub_mod['mod_id']==$mod['mod_id'])
                            @if($sub_mod['submod_route']!=null || $sub_mod['submod_route']!="") 
                                <li class="nav-item" >
                                    <router-link :to="{ name: '{{ $sub_mod['submod_route']}}', query: {data:'{{ $sub_mod['sub_mod_id'] }}' } }" class="nav-link" onclick="afterclick()">
                                        <i class=" nav-icon {{ $sub_mod['submod_icon']}}"></i>
                                        <p>{{$sub_mod['sub_mod_name']}}</p> 
                                    </router-link>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas {{ $sub_mod['submod_icon']}}"></i>
                                        <p>{{$sub_mod['sub_mod_name']}}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    @if(sizeof(session('User_Details')['screens'])>0)
                                    <ul class="nav nav-treeview">
                                        @foreach(session('User_Details')['screens'] as $scr)
                                        @if($scr['sub_mod_id']==$sub_mod['sub_mod_id'])
                                            <li class="nav-item" >
                                                <router-link :to="{ name: '{{ $scr['route']}}', params: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
                                                    <i class=" nav-icon {{ $scr['screen_icon']}}"></i>
                                                    <p>{{$scr['screen_name']}}</p>
                                                </router-link>
                                            </li>
                                        @endif 
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            @endif
                        @endif
                    @endforeach
                    @foreach(session('User_Details')['screens'] as $i=> $scr)
                        @if($scr['sub_mod_id']=="" && $scr['mod_id']==$mod['mod_id'])
                        <li class="nav-item">
                            <!-- <router-link to="{{$scr['route']}}" class="nav-link">
                            <i class=" nav-icon fas {{ $scr['screen_icon']}}"></i>
                            <p>{{$scr['screen_name']}}</p>
                            </router-link> -->
                            <router-link :to="{ name: '{{ $scr['route']}}', params: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
                                <i class=" nav-icon {{ $scr['screen_icon']}}"></i>
                                <p>{{$scr['screen_name']}}</p>
                            </router-link>
                        </li>
                        @endif
                    @endforeach
                    @endif
                    @foreach(session('User_Details')['screens'] as $scr)
                        @if($mod['mod_id'] == $scr['mod_id'] && $scr['sub_mod_id']==null)
                        <li class="nav-item">
                            <router-link :to="{ name: '{{ $scr['route']}}', params: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
                                <i class=" nav-icon {{ $scr['screen_icon']}}"></i>
                                <p>{{$scr['screen_name']}} </p>
                            </router-link>
                        </li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
            @foreach(session('User_Details')['screens'] as $scr)
                @if($scr['sub_mod_id']=="" && $scr['mod_id']=="")
                <li class="nav-item">
                    <router-link :to="{ name: '{{ $scr['route']}}', params: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
                    <i class=" nav-icon {{ $scr['screen_icon']}}"></i>
                    <p>{{$scr['screen_name']}}</p>
                    </router-link>
                </li>
                @endif
            @endforeach
            @endif
            <hr>
            <li class="nav-item has-treeview" id="mastermanagment">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Master Management
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item" id="dzongkhagmaster">
                        <router-link to="/global_master" class="nav-link pt-1 pb-1">
                            <i class="fa fa-globe nav-icon"></i>
                            Common Masters
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview" id="org_master">
                        <router-link to="/OrganizationMasterIndex" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p> 
                                Organization Masters
                            </p>
                        </router-link> 
                    </li>
                    <li class="nav-item has-treeview" id="staff_master">
                        <router-link to="/staff_link" class="nav-link pt-1 pb-1">
                            <i class="fa fa-users nav-icon"></i>
                            Staff Masters
                        </router-link>
                    </li>  
                    <li class="nav-item has-treeview" id="staff_master">
                        <router-link to="/traing_master" class="nav-link pt-1 pb-1">
                            <i class="fa fa-users nav-icon"></i>
                            HR Development (Training)
                        </router-link>
                    </li>               
                    <li class="nav-item has-treeview" id="studentmaster">
                        <a href="#" class="nav-link pt-1 pb-1">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Student Masters
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a> 
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="studentHealth" onclick="setclass('mastermanagment','studentmaster','studentHealth')">
                                <router-link to="/StudentMasterIndex" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-angle-double-right nav-icon"></i>
                                    Student Health Master
                                </router-link>
                            </li>
                        </ul>
                    </li>
                

                  <!--  <li class="nav-item has-treeview" id="org_master" @click="setclass('mastersmanagement','','std_master')">
                        <router-link to="/StudentMasterIndex" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p> 
                                Studnet Masters
                            </p>
                        </router-link> 
                    </li>-->
                </ul>

                <li class="nav-item has-treeview" id="organizationlink">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Organization
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item" id="establishment" @click="setclass('organizationlink','','establishment')">
                        <router-link to="/establishment_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Establishment 
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="restructuring" @click="setclass('organizationlink','','restructuring')">
                        <router-link to="/restructuring_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Restructuring 
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','facility')">
                        <router-link to="/structural_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Structural Facilities 
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="general" onclick="setclass('organizationlink','','general')">
                        <router-link to="/general_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                General Information 
                            </p>
                        </router-link>
                    </li>
                    <!-- <li class="nav-item" id="annualUpdate" @click="setclass('organizationlink','','annualUpdate')">
                        <router-link to="/annualUpdate" class="nav-link">
                            <i class="fa fa-angle-double-right nav-icon"></i>
                            Data Submission
                        </router-link> 
                    </li> -->
                </ul>
            </li>
            <li class="nav-item has-treeview" id="stafflink">
                <router-link to="/staff_registration" class="nav-link pt-1 pb-1" onclick="afterclick()">
                    <p>
                    <i class="nav-icon fas fa-users-cog"></i>
                        Staff
                    </p>
                </router-link>
            </li>
            
            <li class="nav-item has-treeview" id="studentlink">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Student
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                   <li class="nav-item" id="student_health" onclick="setclass('studentlink','','student_health')">
                       <router-link to="/student_health" class="nav-link pt-1 pb-1">
                            <i class="fa fa-angle-double-right nav-icon"></i>
                            Student Health 
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item" id="select_system">
                <a href="{{route('select_system') }}" class="nav-link text-white">
                    <i class="nav-icon fa fa-sign-out-alt pr-4"></i>
                    <p>Select System</p> 
                </a> 
            </li>
        </ul>
    </nav>
</div>
 