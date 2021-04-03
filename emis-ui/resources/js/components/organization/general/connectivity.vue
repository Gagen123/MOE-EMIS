<template>
    <div>
        <form class="bootbox-form" id="connectivityId">
            <div class="form-group row">
                <input type="hidden" class="form-control" v-model="form.organizationId"/>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-8 ">Approach Road:<span class="text-danger"> *</span></label>
                                    <select name="approachRoad" id="approachRoad" v-model="form.approachRoad" class="form-control editable_fields " @change="approachRoadIsNoRoad()">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Paved</option>
                                        <option value="2">Unpaved</option>
                                        <option value="3">No Road</option>
                                    </select>
                                </div> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-8 ">Electricity Source:<span class="text-danger"> *</span></label>
                                    <select name="electricitySource" v-model="form.electricitySource" id="electricitySource" class="form-control editable_fields " @change="electricitySourceIsGrid()">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Grid</option>
                                        <option value="2">Solar</option>
                                        <option value="3">No electricity</option>
                                    </select>
                                </div> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-12 ">Telephone Service Provider:<span class="text-danger"> *</span></label>
                                    <select name="telephone" v-model="form.telephone" id="telephone" class="form-control editable_fields ">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">No telephone connection</option>
                                        <option value="2">BT</option>
                                        <option value="3">TCell</option>
                                    </select>
                                </div> 
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="col-md-10 ">Internet Service Provider:<span class="text-danger"> *</span></label>
                                    <select name="internet" v-model="form.internet" id="internet" class="form-control editable_fields " @change="internet()">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">No internet connection</option>
                                        <option value="2">BT</option>
                                        <option value="3">TCell</option>
                                    </select>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  noRoad" style="display:none">
                                    <label class="col-md-12 ">Distance from Road Head:</label>
                                    <input type="number" id="" v-model="form.distanceFromRoad" class="form-control" placeholder="KM"/>
                                </div> 
                        
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  noRoad" style="display:none">
                                    <label class="col-md-10 ">Days from Road Head:</label>
                                    <input type="number" id="" v-model="form.daysFromRoad" class="form-control" placeholder="Days"/>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 noRoad" style="display:none">
                                    <label class="col-md-12 ">Hours from Road Head:</label>
                                    <input type="number" id="" v-model="form.hoursFromRoad" class="form-control" placeholder="Hours"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  grid" style="display:none">
                                    <label class="col-md-12 ">Electricity Main Line Supply:</label>
                                    <select name="electricitySupply" v-model="form.electricitySupply" id="electricitySupply" class="form-control editable_fields ">
                                        <option value="">--- Please Select ---</option>
                                        <option value="1">Underground cable</option>
                                        <option value="2">Overhead cable</option>
                                    </select>
                                </div> 
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  grid" style="display:none">
                                    <label class="col-md-10 ">Electrical substation:</label>
                                    <br>
                                    <label><input v-model="form.electricalSubstation"  type="radio" value="1" tabindex="2"/> Yes</label>
                                    <label><input v-model="form.electricalSubstation"  type="radio" value="0" tabindex="3"/> No</label>
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  showDiv" style="display:none">
                                    <label class="col-md-10 ">Bandwidth (Mbps):</label>
                                    <input type="text" v-model="form.bandwidth" id="" class="form-control" placeholder="Mbps"/>
                                </div> 
                                    
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  showDiv" style="display:none">
                                    <label class="col-md-10 ">DrukREN Connection:</label>
                                    <br>
                                    <label><input v-model="form.drukRen"  type="radio" value="1" tabindex="2"/> Yes</label>
                                    <label><input v-model="form.drukRen"  type="radio" value="0" tabindex="3"/> No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <label class="mb-0">Contact Details</label>
            </div>    
            <div class="card">
                <div class="form-group row">
                    <div class="card-body col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table id="dynamic-table" class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Fax</th>
                                    <th>Mobile</th>
                                    <th>Email</th>                            
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="record1" v-for='(user, index) in form.users' :key="index">
                                    <td>
                                        <input type="text" name="fax" class="form-control" v-model="user.contactName"/>
                                    </td>
                                    <td>                                
                                        <input type="text" name="phone" class="form-control" v-model="user.phone"/>
                                    </td>
                                    <td>                                
                                        <input type="text" name="fax" class="form-control" v-model="user.fax"/>
                                    </td>
                                    <td>                                
                                        <input type="text" name="mobile" class="form-control" v-model="user.mobile"/>
                                    </td>
                                    <td>                                
                                        <input type="text" name="email" class="form-control" v-model="user.email"/>
                                    </td>
                                </tr> 
                                <tr>
                                    <td colspan="5"> 
                                        <button type="button" class="btn btn-flat btn-sm btn-primary" id="addMore" 
                                        @click="addMore()"><i class="fa fa-plus"></i> Add More</button>
                                        <button type="button" class="btn btn-flat btn-sm btn-danger" id="remove" 
                                        @click="remove()"><i class="fa fa-trash"></i> Remove</button>
                                    </td>
                                </tr>                                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" @click="formaction('reset')" class="btn btn-flat btn-sm btn-danger"><i class="fa fa-redo"></i> Reset</button>
                <button type="button" @click="formaction('save')" class="btn btn-flat btn-sm btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            count:1,
            users: [],
            form: new form({
                id: '',organizationId:'1',approachRoad: '',electricitySource: '',telephone:'',internet:'',distanceFromRoad:'',
                daysFromRoad:'',hoursFromRoad:'',electricitySupply:'',electricalSubstation:'0',bandwidth:'',
                drukRen:'0',
                users:
                [{
                    contactName:'',phone:'',fax:'',mobile:'',email:''
                }],
            }),
        }
    },

    methods:{

        /**
         * method to save data
         */
        formaction: function(type){
            if(type=="reset"){
                this.form.approachRoad = '';
                this.form.electricitySource = '';
                this.form.telephone = '';
                this.form.internet = '';
            }
            if(type=="save"){
                this.form.post('/organization/saveConnectivity',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Connectivity is added successfully'
                    })
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        /**
         * method to add more fields
         */
        addMore: function(){
            this.count++;
            this.form.users.push({names:'',phone:'',fax:'',mobile:'',email:''})    
        }, 
        /**
         * method to remove fields
         */
        remove(index){    
             if(this.form.users.length>1){
                this.count--;
                this.form.users.splice(index,1); 
            }
        },
       
       /**
        * method to show hidden field if electricity source is grid
        */
        electricitySourceIsGrid: function(){
            let electricitySource = $("#electricitySource").val();
            if(electricitySource == 1){
                $(".grid").show();
            }else{
                $(".grid").hide();
            }
        },

        /**
         * method to show hidden fields if approach road is no road
         */
        approachRoadIsNoRoad: function(){
            let approachRoad = $("#approachRoad").val();
            if(approachRoad == 3){
                $(".noRoad").show();
            }else{
                $(".noRoad").hide();
            }
        },

        /**
         * method to show hidden fields if internet is BT or TCell
         */
        internet: function(){
            let service = $("#internet").val();
            if(service == 2 || service == 3){
                $(".showDiv").show();
            }else{
                $(".showDiv").hide();
            }
        },
    }
}
</script>