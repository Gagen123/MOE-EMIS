<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="img/new_logo.png" type="image/x-icon" />
  <title>EMIS::Education Management Information System</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini text-sm request_loading">
    <div class="modal_loadming">
      <div class="lds-grid">
        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
      </div>
    </div>
    <div class="wrapper" id="app">
    @include('common.header')
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:#E5E5E5">
            @include('common.logo')
            @include('common.sidebar')
        </aside>
        <div class="content-wrapper">
            <section class="content">
              <router-view></router-view>

            </section>
        </div>
        @include('common.footer')
    </div>

    <script src="js/app.js"></script>
</body>
<script>


    //load on page refresh and page load
    getNotification();
    getsideScreens();
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
            window.location="{{route('logout') }}";
          }
      });
    }

    let count=10;
    setInterval(function(){
        getNotification();
    }, 50000);
    function getNotification(){
        axios.get('common/getNotification')
        .then(response => {
            let data = response.data;
            if(data!=undefined){
                $('#n_details').html('');
                $('#notificationcount').html(data.length);
                data.forEach(item =>{
                    $('#n_details').append(
                        ' <a href="#/'+item.call_back_link+'?data='+item.id+'" class="nav-link "><b>'+ item.notification_for +'</b><br>('+ item.notification_appNo+')</a><br />'
                    );
                });
            }
        });
    }

    function getsideScreens(){
        $('#sidebars').html('');
        let menu="";
        let moduleList=[];
        axios.get('common/getscreens/module')
        .then(response =>{
            moduleList= response.data;
        });

        axios.get('common/getscreens/submodule')
        .then(response =>{
            let submoduleList= response.data;
            if(moduleList!=undefined){
                if(moduleList.length!=undefined){
                    moduleList.forEach(item =>{
                        if(item.moudle_name!=null && item.moudle_name!="null" && item.moudle_name!=""){
                            menu=menu+'<li class="nav-item has-treeview"><a href="#" class="nav-link border-bot text-body text-body pt-1 pb-1">'+
                            '<i class=" '+item.module_icon+'"></i> <p>'+item.moudle_name+
                            '<i class="right fas fa-angle-left"></i></p>'+
                            '</a>';
                        }
                        if(item.moudle_name==null && item.screenName!=null && item.screenName!=""){
                            menu=menu+'<li class="nav-item"><a href="#/'+item.Route+'" class="nav-link border-bot text-body text-body pt-1 pb-1">'+
                            '<i class=" '+item.screen_icon+'"></i> <p>'+item.screenName+
                            '</p></a>';
                        }

                        if(item.moudle_name!=null && submoduleList!=undefined){
                            menu=menu+'<ul class="nav nav-treeview">';
                                submoduleList.forEach(sub_item =>{
                                if(sub_item.mod_id_In_sub==item.module_id){
                                    menu=menu+'<li class="nav-item ">'+
                                    '<a href="#/'+sub_item.sub_mod_route+'?data='+sub_item.sub_module_id+'" class="nav-link text-body border-bot text-body">'+
                                    '<i class=" nav-icon '+sub_item.submod_icon+'"></i>'+
                                    '<p>'+sub_item.sub_module_name+'</p>'+
                                    '</a></li>';
                                }
                            });
                            menu=menu+'</ul>';
                        }
                        menu=menu+'</li>';
                    });
                }
                $('#sidebars').html(menu);
            }
        });
    }

    $('#mainmenu >li >a').addClass('border-bot text-body');
    $('#mainmenu >li >ul >li >a').addClass('border-bot text-body');
    $('#mainmenu >li >ul >li >ul >li >a').addClass('border-bot text-body');
    function afterclick(){
        $('#mainmenu >li >a').addClass('border-bot text-body');
        $('#mainmenu >li >ul >li >a').addClass('border-bot text-body');
        $('#mainmenu >li >ul >li >ul >li >a').addClass('border-bot text-body');
    }
    </script>
</html>

