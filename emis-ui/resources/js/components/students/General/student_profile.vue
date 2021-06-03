<template>
    <div>
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ol class="breadcrumb"> 
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Student</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="text-center">
							<img class="profile-user-img img-fluid img-circle"
								src=""
								alt="User profile picture">
						</div>
                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Class</strong>

                        <p class="text-muted">
                            Class: 10  Sec: B
                        </p>
                        <hr>
                        <strong><i class="fas fa-building mr-1"></i> House</strong>

                        <p class="text-muted">
                            Yellow House
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#basicdetails" data-toggle="tab">Basic Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#guardain" data-toggle="tab">Guardain Details</a></li>
                        <li class="nav-item"><a class="nav-link" href="#others" data-toggle="tab">Others</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                        <div class="active tab-pane" id="basicdetails">
                            <strong><i class="fas fa-file-alt mr-1"></i> Details</strong>
                            <p class="text-muted">
                                To Serve the Nation
                            </p>

                            <strong><i class="fas fa-file-alt mr-1"></i> Detais</strong>
                            <p class="text-muted">
                                Education for All
                            </p>
                        </div>
                        <div class="tab-pane" id="guardain">
                            <strong><i class="fas fa-file-alt mr-1"></i> Parents Details</strong>
                                <p class="text-muted">
                                    To Serve the Nation
                                </p>

                                <strong><i class="fas fa-file-alt mr-1"></i> Parents Details</strong>
                                <p class="text-muted">
                                    Education for All
                                </p>
                        </div>

                        <div class="tab-pane" id="others">
                            <strong><i class="fas fa-file-alt mr-1"></i> Guardian Detais</strong>
                                <p class="text-muted">
                                    To Serve the Nation
                                </p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


</script>