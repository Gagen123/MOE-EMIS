<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" id="mainmenu" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="dashboard" class="nav-link pt-1 pb-1">
                    <i class=" nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <!-- @if(session('User_Details')!=null)
            @foreach (session('User_Details')['modules'] as $mod)
                @if($mod['module_route']!=null || $mod['module_route']!="")
                <li class="nav-item" >
                    <router-link id="{{$mod['module_route']}}" :to="{ name: '{{ $mod['module_route']}}', query: {data:'{{ $mod['mod_id'] }}' } }" class="nav-link" onclick="afterclick()">
                        <i class=" {{ $mod['module_icon']}}"></i>
                        <p>{{$mod['mod_name']}} </p>
                    </router-link>
                </li>
                @else
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link pt-1 pb-1">
                        <i class="{{ $mod['module_icon']}}"></i>
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
                                                        <router-link :to="{ name: '{{ $scr['route']}}', query: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
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
                            @endforeach -->


                            <!-- @foreach(session('User_Details')['screens'] as $i=> $scr)
                                @if($scr['sub_mod_id']=="" && $scr['mod_id']==$mod['mod_id'])
                                <li class="nav-item">
                                    <router-link :to="{ name: '{{ $scr['route']}}', query: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
                                        <i class=" nav-icon {{ $scr['screen_icon']}}"></i>
                                        <p>{{$scr['screen_name']}}</p>
                                    </router-link>
                                </li>
                                @endif
                            @endforeach -->


                        <!-- @endif
                        @foreach(session('User_Details')['screens'] as $scr)
                            @if($mod['mod_id'] == $scr['mod_id'] && $scr['sub_mod_id']==null)
                            <li class="nav-item">
                                <router-link :to="{ name: '{{ $scr['route']}}', query: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link" onclick="afterclick()">
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
                    <router-link :to="{ name: '{{ $scr['route']}}', query: {data:'{{ $scr['actions'] }}',screen_id:'{{ $scr['screen_id'] }}',work_flow_status:'{{ $scr['work_flow_status'] }}' } }" class="nav-link pl-1" onclick="afterclick()">
                    <i class=" nav-icon {{ $scr['screen_icon']}}"></i>
                    <p>{{$scr['screen_name']}}</p>
                    </router-link>
                </li>
                @endif
            @endforeach
            @endif
            <br>
            <br>
            <hr>
            Developers Menu -->
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
                        <a href="#" class="nav-link pt-1 pb-1">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Staff Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="dzongkhagmaster">
                                <router-link to="/staff_link" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-users nav-icon"></i>
                                    Staff
                                </router-link>
                            </li>
                            <li class="nav-item" id="dzongkhagmaster">
                                <router-link to="/qualification_index" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-users nav-icon"></i>
                                    Qualification
                                </router-link>
                            </li>
                            <li class="nav-item" id="dzongkhagmaster">
                                <router-link to="/position_directory_index" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-users nav-icon"></i>
                                    Position Directory
                                </router-link>
                            </li>
                            <li class="nav-item" id="dzongkhagmaster">
                                <router-link to="/transfer_master_index" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-users nav-icon"></i>
                                    Staff Transfer
                                </router-link>
                            </li>
                            <li class="nav-item has-treeview" id="staff_master">
                                <router-link to="/staff_award_index" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-users nav-icon"></i>
                                    Staff Service Master
                                </router-link>
                            </li>
                            <li class="nav-item has-treeview" id="staff_master">
                                <router-link to="/traing_master" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-users nav-icon"></i>
                                    HR Development (Training)
                                </router-link>
                            </li>
                            <li class="nav-item" id="management_body_link">
                                <router-link to="/management_body_link" class="nav-link">
                                    <i class="nav-icon fas fa-mail-bulk"></i>
                                    Management Body Master
                                </router-link>
                            </li>
                            <li class="nav-item" id="leave_index">
                                <router-link to="/leave_index" class="nav-link">
                                    <i class="nav-icon fas fa-mail-bulk"></i>
                                    Leave & Others
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview" id="studentmaster">
                        <a href="#" class="nav-link pt-1 pb-1">
                            <i class="nav-icon fas fa-user-graduate"></i>
                            <p>
                                Student Masters
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="validation_and_others">
                                <router-link to="/validation_and_others" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-angle-double-right nav-icon"></i>
                                    Validation Rules & Others
                                </router-link>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="studentServices">
                                <router-link to="/StudentServicesMasterIndex" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-angle-double-right nav-icon"></i>
                                    Non-Academics Master
                                </router-link>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="studentadmission">
                                <router-link to="/studentAdmissionMasterIndex" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-angle-double-right nav-icon"></i>
                                    Admission Master
                                </router-link>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="studentHealth">
                                <router-link to="/StudentHealthMasterIndex" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-angle-double-right nav-icon"></i>
                                    Health Master
                                </router-link>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" id="studentCea">
                                <router-link to="/StudentCeaMasterIndex" class="nav-link pt-1 pb-1">
                                    <i class="fa fa-angle-double-right nav-icon"></i>
                                    Programs & Clubs
                                </router-link>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview" id="academicmaster">
                        <router-link to="/academic-master" class="nav-link pt-1 pb-1">
                            <i class="fa fa-book nav-icon"></i>
                            Academic Masters
                        </router-link>
                    </li>
                </ul>
            <!--academic-->
                <li class="nav-item has-treeview" id="academic">
                    <router-link to="/academic" class="nav-link pt-1 pb-1">
                        <i class="nav-icon fas fa-book"></i>
                            Academics
                    </router-link>
                </li>
                <li class="nav-item has-treeview" id="organizationlink">
            </li>

            <li class="nav-item has-treeview" id="organization">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-save"></i>
                    <p>
                        Approval
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item" id="establishment">
                        <router-link to="/establishment_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Establish Organization
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="restructuring">
                        <router-link to="/restructuring_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Change In Organization
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="recuritment">
                        <router-link to="/recuritment_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Staff Approval
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>

            <li class="nav-header"></li>
            <li class="nav-item has-treeview" id="organization">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Organization
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if(session('User_Details')!=null)
                        @if(session('User_Details')['acess_level']=="Org")
                            <li class="nav-item has-treeview" >
                                <router-link to="/view_organization_profile" class="nav-link pt-1 pb-1">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                    View Org Profile
                                </router-link>
                            </li>
                        @endif
                        @if(session('User_Details')['acess_level']=="Dzongkhag")
                            <li class="nav-item has-treeview" >
                                <router-link to="/view_dzongkhag_profile" class="nav-link pt-1 pb-1">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                    View Org Profile
                                </router-link>
                            </li>
                        @endif
                        @if(session('User_Details')['acess_level']=="Ministry")
                            <li class="nav-item has-treeview" >
                                <router-link to="/view_department_profile" class="nav-link pt-1 pb-1">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                    View Org Profile
                                </router-link>
                            </li>
                        @endif
                    @endif

                    <li class="nav-item" id="organization_list">
                        <router-link to="/organization_list" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                View Org List
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item" id="restructuring">
                        <router-link to="/mission_vission" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Mission & Vission
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="restructuring">
                        <router-link to="/basic_details_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Basic Details
                            </p>
                        </router-link>
                    </li>
                    @if(session('User_Details')!=null)
                        @if(session('User_Details')['acess_level']=="Org")
                            @foreach(session('User_Details')['roles'] as $key => $user_role)
                                @if($user_role->roleName == "ECCD Principal")
                                    <li class="nav-item has-treeview" >
                                        <router-link to="/detailed_information_eccd" class="nav-link pt-1 pb-1">
                                        <i class="fa fa-angle-double-right nav-icon"></i>
                                            Detailed Information
                                        </router-link>
                                    </li>
                                @else
                                    <li class="nav-item has-treeview" >
                                        <router-link to="/detailed_information_school" class="nav-link pt-1 pb-1">
                                        <i class="fa fa-angle-double-right nav-icon"></i>
                                            Detailed Information
                                        </router-link>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endif

                    <li class="nav-item" id="restructuring">
                        <router-link to="/visitors_information" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Organizaiton Visitor
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="restructuring">
                        <router-link to="/org_class_section" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Class Section
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','org_programs')">
                        <router-link to="/org_programs" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Programs & Clubs
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','facility')">
                        <router-link to="/general_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Equipments and Furnitures
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','facility')">
                        <router-link to="/structural_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Facilities
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="sen_module_index" onclick="setclass('organizationlink','','sen_module_index')">
                        <router-link to="/sen_module_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                SEN Module
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="management_body" onclick="setclass('organizationlink','','management_body')">
                    <!-- <li class="nav-item" id="track_application"> -->
                        <router-link to="/management_body" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Management Body
                            </p>
                        </router-link>
                    </li>

                    <!-- <li class="nav-item" id="general" onclick="setclass('organizationlink','','general')">
                        <router-link to="/general_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Other Information
                            </p>
                        </router-link>
                    </li> -->
                    <!-- <li class="nav-item" id="financial_information" onclick="setclass('financial_information','','financial_information')">
                        <router-link to="/financial_information" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Latest Missing Menus Added
                            </p>
                        </router-link>
                    </li> -->
                </ul>
            </li>
            
            <!-- ECCD Center -->

            <li class="nav-header"></li>
            <li class="nav-item has-treeview" id="organization">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        ECCD Center
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if(session('User_Details')!=null)
                        @if(session('User_Details')['acess_level']=="Org")
                            <li class="nav-item has-treeview" >
                                <router-link to="/view_organization_profile" class="nav-link pt-1 pb-1">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                    View Org Profile
                                </router-link>
                            </li>
                        @endif
                        @if(session('User_Details')['acess_level']=="Dzongkhag")
                            <li class="nav-item has-treeview" >
                                <router-link to="/view_dzongkhag_profile" class="nav-link pt-1 pb-1">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                    View Org Profile
                                </router-link>
                            </li>
                        @endif
                        @if(session('User_Details')['acess_level']=="Ministry")
                            <li class="nav-item has-treeview" >
                                <router-link to="/view_department_profile" class="nav-link pt-1 pb-1">
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                    View Org Profile
                                </router-link>
                            </li>
                        @endif
                    @endif

                    <li class="nav-item" id="organization_list">
                        <router-link to="/organization_list" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                View Org List
                            </p>
                        </router-link>
                    </li>

                    <li class="nav-item" id="restructuring">
                        <router-link to="/mission_vission" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Mission & Vission
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="restructuring">
                        <router-link to="/basic_details_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Basic Details
                            </p>
                        </router-link>
                    </li>
                    @if(session('User_Details')!=null)
                        @if(session('User_Details')['acess_level']=="Org")
                            @foreach(session('User_Details')['roles'] as $key => $user_role)
                                @if($user_role->roleName == "ECCD Principal")
                                    <li class="nav-item has-treeview" >
                                        <router-link to="/detailed_information_eccd" class="nav-link pt-1 pb-1">
                                        <i class="fa fa-angle-double-right nav-icon"></i>
                                            Detailed Information
                                        </router-link>
                                    </li>
                                @else
                                    <li class="nav-item has-treeview" >
                                        <router-link to="/detailed_information_school" class="nav-link pt-1 pb-1">
                                        <i class="fa fa-angle-double-right nav-icon"></i>
                                            Detailed Information
                                        </router-link>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endif

                    <li class="nav-item" id="restructuring">
                        <router-link to="/visitors_information" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Organizaiton Visitor
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="restructuring">
                        <router-link to="/org_class_section" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Class Section
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','org_programs')">
                        <router-link to="/org_programs" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Programs & Clubs
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','facility')">
                        <router-link to="/general_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Equipments and Furnitures
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="facility" onclick="setclass('organizationlink','','facility')">
                        <router-link to="/structural_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Facilities
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="sen_module_index" onclick="setclass('organizationlink','','sen_module_index')">
                        <router-link to="/sen_module_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                SEN Module
                            </p>
                        </router-link>
                    </li>
                   
                   
                </ul>
            </li>





            <li class="nav-header"></li>
            <li class="nav-item has-treeview" id="staff-transaction">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Staff
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item has-treeview" id="stafflink">
                        <router-link to="/staff_registration" class="nav-link pt-1 pb-1">
                            <p>
                            <i class="nav-icon fas fa-users-cog"></i>
                                Staff Details
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview" id="inset_link">
                        <router-link to="/create_inset" class="nav-link pt-1 pb-1">
                            <p>
                            <i class="nav-icon fas fa-list"></i>
                                Hr Development
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item has-treeview" id="inset_link">
                        <router-link to="/leave_service_index" class="nav-link pt-1 pb-1">
                            <p>
                            <i class="nav-icon fas fa-list"></i>
                                Leave Services
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="track_application">
                        <router-link to="/staff_services_index" class="nav-link">
                            <p>
                                <i class="nav-icon fas fa-list"></i>
                                Staff Services
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="track_application">
                        <router-link to="/staff_leadership_selection_index" class="nav-link">
                            <p>
                                <i class="nav-icon fas fa-list"></i>
                                Leadership Selection
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-header"></li>
            <li class="nav-item has-treeview" id="studentlink">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fas fa-user-graduate"></i>
                    <p>
                        Student
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item" id="studentlist">
                        <router-link to="/student_list" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Student List
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="admission">
                        <router-link to="/student_admission" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Admission Services
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="studentservices">
                        <router-link to="/class_section" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Class Section Allocation
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="studentservices">
                        <router-link to="/student_services" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Student Services
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="studenthealth">
                        <router-link to="/student_health" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Student Health
                            </p>
                        </router-link>
                    </li>

                    <!-- Non-Academic Activities -->
                    <li class="nav-item" id="programs">
                        <router-link to="/student_programs_clubs" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Programs & Clubs
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="scouts">
                        <router-link to="/student_scouts_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Scouts
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="clubs">
                        <router-link to="/student_trainings_index" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                Trainings & Workshop
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="send">
                        <router-link to="/student_sen_list" class="nav-link">
                            <p>
                                <i class="fa fa-angle-double-right nav-icon"></i>
                                SEN
                            </p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-header"></li>
            <li class="nav-item has-treeview" id="studentlink">
                <a href="#" class="nav-link pt-1 pb-1">
                    <i class="nav-icon fa fa-adjust"></i>
                    <p>
                        Other Transactions
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item" id="track_application">
                        <router-link to="/question_answer_index" class="nav-link">
                            <p>
                                <i class="fa fa-question nav-icon"></i>
                                Question & Answer set up
                            </p>
                        </router-link>
                    </li>
                    <li class="nav-item" id="messlink">
                        <router-link to="/messManage_index" class="nav-link">
                            <p>
                            <i class="nav-icon fa fa-carrot"></i>
                                Mess Management
                            </p>
                        </router-link>
                    </li>
                    
                </ul>
            </li>

            <li class="nav-item" id="track_application">
                <router-link to="/track_application" class="nav-link">
                    <p>
                        <i class="fa fa-search nav-icon"></i>
                        Track Application
                    </p>
                </router-link>
            </li>
            <li class="nav-item" id="tasklist">
                <router-link to="/tasklist" class="nav-link">
                    <p>
                        <i class="fa fa-list nav-icon"></i>
                        Task List
                    </p>
                </router-link>
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
