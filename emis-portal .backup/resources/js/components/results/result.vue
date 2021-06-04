<template>
  <div>
    <div class="col-8 center">
      <div class="card card-success card-outline">
        <div class="content-header pt-1 pb-0">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h5><b>Fill the details to view your Results</b></h5>
              </div>
            </div>
          </div>
        </div>
        <hr />
        <div class="card-body">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8 center">
            <label class="col-md-8"
              >Dzongkhag/Thromde:<span class="text-danger"> *</span></label
            >
            <select
              name="approachRoad"
              id="approachRoad"
              class="form-control editable_fields"
              @change="approachRoadIsNoRoad()"
            >
              <option value="">--- Please Select ---</option>
              <option value="1">Thimphu</option>
              <option value="2">Punakha</option>
              <option value="3">Wangdue</option>
            </select>
          </div>

          <hr />
          <div class="col-lg-6 col-md-3 col-sm-3 col-xs-8 center">
            <label class="col-md-8"
              >School:<span class="text-danger"> *</span></label
            >
            <select
              name="approachRoad"
              id="approachRoad"
              class="form-control editable_fields"
              @change="approachRoadIsNoRoad()"
            >
              <option value="">--- Please Select ---</option>
              <option value="1">YHSS</option>
              <option value="2">MHSS</option>
              <option value="3">Pelkil HSS</option>
            </select>
          </div>
          <hr />
          <div class="col-lg-6 col-md-3 col-sm-3 col-xs-8 center">
            <label class="col-md-8"
              >Class:<span class="text-danger"> *</span></label
            >
            <select
              name="approachRoad"
              id="approachRoad"
              class="form-control editable_fields"
              @change="approachRoadIsNoRoad()"
            >
              <option value="">--- Please Select ---</option>
              <option value="1">PP</option>
              <option value="2">1</option>
              <option value="3">2</option>
              <option value="3">3</option>
              <option value="3">10</option>
            </select>
          </div>
          <hr />
          <div class="col-lg-6 col-md-3 col-sm-3 col-xs-8 center">
            <label class="col-md-8"
              >Section:<span class="text-danger"> *</span></label
            >
            <select
              name="approachRoad"
              id="approachRoad"
              class="form-control editable_fields"
              @change="approachRoadIsNoRoad()"
            >
              <option value="">--- Please Select ---</option>
              <option value="1">A</option>
              <option value="2">B</option>
              <option value="3">C</option>
            </select>
          </div>
          <hr />

          <div class="col-lg-6 col-md-3 col-sm-3 col-xs-8 center">
            <label class="col-md-8"
              >Student Code:<span class="text-danger"> *</span></label
            >
            <input
              v-model="form.cid_no"
              type="number"
              name="cid_no"
              placeholder="Student Number"
              autofocus="autofocus"
              class="form-control"
              :class="{ 'is-invalid': form.errors.has('cid_no') }"
              @keyup.enter="getInstructorDetailsbyCID()"
              data-toggle="tooltip"
              data-placement="top"
              title="Tooltip on top"
            />
          </div>
          <hr />
          <div class="row form-group">
            <div class="col-12">
              <button
                type="button"
                @click="submitform()"
                id="btnsave"
                class="btn btn-flat btn-success"
              >
                <i class="fa fa-save"></i> View result
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueTagsInput from "@johmun/vue-tags-input";

export default {
  components: {
    VueTagsInput,
  },
  data() {
    return {
      editmode: false,
      products: {},
      form: new form({
        id: "",
        category: "",
        name: "",
        description: "",
        tags: [],
        photo: "",
        category_id: "",
        price: "",
        photoUrl: "",
      }),
      categories: [],

      tag: "",
      autocompleteItems: [],
    };
  },
  methods: {
    getResults(page = 1) {
      this.$Progress.start();

      axios
        .get("api/product?page=" + page)
        .then(({ data }) => (this.products = data.data));

      this.$Progress.finish();
    },
    loadProducts() {
      // if(this.$gate.isAdmin()){
      axios.get("api/product").then(({ data }) => (this.products = data.data));
      // }
    },
    loadCategories() {
      axios
        .get("/api/category/list")
        .then(({ data }) => (this.categories = data.data));
    },
    loadTags() {
      axios
        .get("/api/tag/list")
        .then((response) => {
          this.autocompleteItems = response.data.data.map((a) => {
            return { text: a.name, id: a.id };
          });
        })
        .catch(() => console.warn("Oh. Something went wrong"));
    },
    editModal(product) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      this.form.fill(product);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },
    createProduct() {
      this.$Progress.start();

      this.form
        .post("api/product")
        .then((data) => {
          if (data.data.success) {
            $("#addNew").modal("hide");

            Toast.fire({
              icon: "success",
              title: data.data.message,
            });
            this.$Progress.finish();
            this.loadProducts();
          } else {
            Toast.fire({
              icon: "error",
              title: "Some error occured! Please try again",
            });

            this.$Progress.failed();
          }
        })
        .catch(() => {
          Toast.fire({
            icon: "error",
            title: "Some error occured! Please try again",
          });
        });
    },
    updateProduct() {
      this.$Progress.start();
      this.form
        .put("api/product/" + this.form.id)
        .then((response) => {
          // success
          $("#addNew").modal("hide");
          Toast.fire({
            icon: "success",
            title: response.data.message,
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.loadProducts();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deleteProduct(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        // Send request to the server
        if (result.value) {
          this.form
            .delete("api/product/" + id)
            .then(() => {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
              // Fire.$emit('AfterCreate');
              this.loadProducts();
            })
            .catch((data) => {
              Swal.fire("Failed!", data.message, "warning");
            });
        }
      });
    },
  },
  mounted() {},
  created() {
    this.$Progress.start();

    this.loadProducts();
    this.loadCategories();
    this.loadTags();

    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter((i) => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
};
</script>
