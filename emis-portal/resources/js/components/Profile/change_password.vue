<template>
    <div class="container-fluid">
        <div class="card card-primary card-outline" id="newworkflow">
            <div class="card-header bg-white">
                <h3 class="card-title">Change your password</h3>
            </div>
            <div class="card-body">
                <div class="bootbox-body">
                    <form class="change-password-form">
                        <div class="">
                            <div class="row form-group">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="text-danger" id="error_msg"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Current Password:</label>
                                    <input name="current_password" id="current_password" @change="removeerror('current_password','current_password_err')" class="form-control" v-model="form.current_password"  type="password">
                                    <span class="text-danger" id="current_password_err"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>New Password:</label>
                                    <input name="new_password" id="new_password" @change="removeerror('new_password','new_password_err')" class="form-control" v-model="form.new_password"  type="password">
                                    <span class="text-danger" id="new_password_err"></span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Confirm Password:</label>
                                    <input name="confirm_password" id="confirm_password" @change="removeerror('confirm_password','confirm_password_err')" class="form-control" v-model="form.confirm_password"  type="password">
                                    <span class="text-danger" id="confirm_password_err"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer">
                <div class="row form-group fa-pull-right">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-flat btn-primary" @click="updatepassword()"> <i class="fa fa-edit"></i> Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data(){
        return  {
            form: new form({
                current_password:'',
                new_password:'',
                confirm_password:'',
            })
        }
    },
    methods:{
        updatepassword(){
            if(this.validatefield()){
                $('#error_msg').html('');
                this.form.post('change_password_portal')
                .then((response) => {
                    if(response.data.includes('Sccess')){
                        Toast.fire({
                            icon: 'success',
                            title: 'Password Updated Successfully'
                        })
                    }
                    else{
                        Toast.fire({
                            icon: 'danger',
                            title: 'Not able to update password:'+response.data
                        });
                        $('#error_msg').html(response.data);
                    }
                })
                .catch((err) => {
                    console.log("Error:"+err)
                });
            }
        },
        validatefield(){
            let returntype=true;
            if(this.form.current_password==null || this.form.current_password==""){
                $('#current_password').addClass('is-invalid');
                $('#current_password').focus();
                $('#current_password_err').html('Plese metion current password');
                returntype=false;
            }

            if(this.form.new_password==null || this.form.new_password==""){
                $('#new_password').addClass('is-invalid');
                $('#new_password').focus();
                $('#new_password_err').html('Plese metion new password');
                returntype=false;
            }
            if(this.form.current_password == this.form.new_password){
                $('#new_password').addClass('is-invalid');
                $('#new_password').focus();
                $('#new_password_err').html('Current password and new password cannot be same');
                returntype=false;
            }
            if(this.form.confirm_password==null || this.form.confirm_password==""){
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').focus();
                $('#confirm_password_err').html('Plese confirm password');
                returntype=false;
            }
            if(this.form.new_password!=this.form.confirm_password){
                $('#confirm_password').addClass('is-invalid');
                $('#confirm_password').focus();
                $('#confirm_password_err').html('new password and confirm password mismatch');
                returntype=false;
            }
            return returntype;
        },
        removeerror(fieldid,errid){
            if($('#'+fieldid).val()!=""){
                $('#'+fieldid).removeClass('is-invalid');
                $('#'+errid).html('');
            }
        },
    }
}
</script>
