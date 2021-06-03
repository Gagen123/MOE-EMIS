<template>
  <div class="container-fluid">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item">User Profile</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img
                class="profile-user-img img-fluid img-circle"
                src="/images/logo.png"
                alt="User profile picture"
              />
            </div>
            <h3 class="profile-username text-center">Full Name</h3>
            <p class="text-muted text-center">{{ user }}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Name</b><a class="float-right">Full Name</a>
              </li>
              <li class="list-group-item">
                <b>School Name</b> <a class="float-right">YHSS</a>
              </li>
              <li class="list-group-item">
                <b>Dzongkhag</b> <a class="float-right">Thimphu</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-8">
        <div class="card card-success card-outline">
          <div class="card-header">
            <h3 class="card-title">About Me</h3>
          </div>
          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>

            <p class="text-muted">
              B.S. in Computer Science from the University of Tennessee at
              Knoxville
            </p>
            <hr />
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
            <p class="text-muted">Malibu, California</p>
            <hr />
            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
            <p class="text-muted">
              <span class="tag tag-danger">UI Design</span>
              <span class="tag tag-success">Coding</span>
              <span class="tag tag-info">Javascript</span>
              <span class="tag tag-warning">PHP</span>
              <span class="tag tag-primary">Node.js</span>
            </p>
            <hr />
            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
            <p class="text-muted">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
              fermentum enim neque.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      user: "",
    };
  },

  mounted() {
    axios
      .get("verify")
      .then((response) => {
        this.user = response.data.user;
      })
      .catch((error) => {});
  },
};
</script>