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
    $('#mainmenu >li >a').addClass('border-bot');
    $('#mainmenu >li >ul >li >a').addClass('border-bot');
    $('#mainmenu >li >ul >li >ul >li >a').addClass('border-bot');
    $('#mainmenu >li >a').addClass('text-body');
    $('#mainmenu >li >ul >li >a').addClass('text-body');
    $('#mainmenu >li >ul >li >ul >li >a').addClass('text-body');
    function afterclick(){
     // $(this).prop("a").addClass('active');
      $('#mainmenu >li >a').addClass('border-bot');
      $('#mainmenu >li >ul >li >a').addClass('border-bot');
      $('#mainmenu >li >ul >li >ul >li >a').addClass('border-bot');
      $('#mainmenu >li >a').addClass('text-body');
      $('#mainmenu >li >ul >li >a').addClass('text-body');
      $('#mainmenu >li >ul >li >ul >li >a').addClass('text-body');
    }
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
    getNotification();
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
                        '<a href="#/'+item.call_back_link+'" class="nav-link "><b>'+ item.notification_for +'</b> ('+ item.notification_message+')</a>'
                    );
                });
            }
        });
    }
    </script>
</html>

