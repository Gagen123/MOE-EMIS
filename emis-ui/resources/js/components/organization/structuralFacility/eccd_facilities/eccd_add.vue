<template>
    <div>
        <form class="bootbox-form" id="sportId">
            <div class="card-body">
                <form class="form-horizontal">
                <div class="row invoice-info">
                    <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>LOCATION</u></i></label>
                    </div>
                    <div class="col-sm-10 invoice-col">
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Is the centre located away from Industries and factories?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">  How far is it located from the parents school/ nearest communities?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields " id="noOfFloor" type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div>
                    </div>
                </div>
                <hr>
                  <div class="row invoice-info">
                      <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>BUILDINGS</u></i></label>
                    </div>
                       <div class="col-sm-10 invoice-col">
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">  Is it a permanent structure?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                        <option value="">yes</option>
                                        <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">  Is it a temporary structure?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">  Is it a concrete structure?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Is it a traditional building?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        
                          <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Is it a community structure (NFE Centre/ORC/BHU/Old Lhakhag/ a newly built structure?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 
                    </div>
                 </div>
                 <hr>
                    <div class="row invoice-info">
                        <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>INDOOR SPACE</u></i></label>
                    </div>
                       <div class="col-sm-10 invoice-col">
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Walls and ceiling in the rooms are strong  and free from holes/peeling papers/ paints?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div> 

                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Does it have a minimum indoor play space of two square metre of floor area per child for daily activies?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Are there good and natural lighting facilities?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div> 
                         <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Is it  adequately ventilated?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Has a separate room for napping equipped with a minimum of three sets of mattress, sheet and blanket for a group of 15 children.?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div> 
                         <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Has closet/drawers for storing children’s personal belongin?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">The floors are clean and free from holes,torn carpets and insects?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div> 
                       </div>
                    </div> 

                         <hr>
                        <div class="row invoice-info">
                            <div class="col-sm-2 invoice-col">
                            <label class="mb-0"><i><u>INDOOR SPACE & EQUIPMENTS</u></i></label>
                        </div>
                       <div class="col-sm-10 invoice-col">

                         <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Sets of building blocks( minimum of 20 pieces in a set):<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }" >
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Item for table activities ( matching game/ lotto/ string beads, etc).:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of puzzles.:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Small hand-held toys:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No Of Art supplier such as paper, play dough..etc:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Dolls with accessories & house hold items.:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of puppets:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Books age appropriate:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Tape/CD Players:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor" :class="{ 'is-invalid': form.errors.has('facility') }" >
                                </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">No of Musical instruments:<span class="text-danger">*</span></label>
                                 <div class="col-lg-4 col-md-4 col-sm-4">
                                    <input class="form-control editable_fields "  type="text" v-model="form.noOfFloor"  :class="{ 'is-invalid': form.errors.has('facility') }">
                                </div>
                        </div> 
                    </div>
                </div>
                <hr>
                <div class="row invoice-info">
                      <div class="col-sm-2 invoice-col">
                        <label class="mb-0"><i><u>OUTDOOR SPACE & EQUIPMENTS</u></i></label>
                    </div>
                       <div class="col-sm-10 invoice-col">
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre have a a minimum outdoor play space of 50 square metre for every group of15 children for routine use by children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Does the centre has fencing around it?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Does the centre Has 2 slides for every group of 15 children.?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has 2 swings for every group of 15 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                                </div>
                        </div>
                        
                          <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has two sea saws for every group?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 

                             <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label"> Does the centre Has a sand pit for every group of 14 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 

                             <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has 3 balls for every group of 15 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 

                        <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has two sets of items for sand and water play?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 
                           <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has a  ladder climbing for every group of 15 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 
                           <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre has a mini basket ball facilities for a group of every 15 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 
                         <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has a tunnel race facilities for every group of 15 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 
                         <div class="form-group row">
                            <label class="col-lg-8 col-md-8 col-sm-8 col-form-label">Does the centre Has a set of skipping ropes for every group of 15 children?:<span class="text-danger">*</span></label>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <select name="facility" id="facility" class="form-control editable_fields" :class="{ 'is-invalid': form.errors.has('facility') }" v-model="form.facility">
                                        <option value="">--- Please Select ---</option>
                                            <option value="">yes</option>
                                            <option value="">no</option>
                                    </select>
                                    <has-error :form="form" field="facility"></has-error>
                             </div>
                         </div> 
                    </div>
                 </div>
             </form>
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
            form: new form({
                id: '', 
                organizationId:'', 
                facility: '',
                yearOfEstablish: '',
                supportedBy: '',
                status: '1',
                numberOfFacility: '',
            })
        }
    },

    methods:{
        remove_err(field_id){
            if($('#'+field_id).val()!=""){
                $('#'+field_id).removeClass('is-invalid');
            }
        },

        formaction: function(type){
            if(type=="reset"){
                this.form.facility= '';
                this.form.yearOfEstablish= '';
                this.form.supportedBy= '';
                this.form.status= '1';
                this.form.numberOfFacility='';
            }
            if(type=="save"){
                this.form.post('/organization/saveEccd',this.form)
                    .then(() => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Eccd facilities added successfully'
                    })
                    this.$router.push('/eccd_list');
                })
                .catch(() => {
                    console.log("Error......")
                })
            }
		},

        getFacilityDropdown(uri = '/organization/getFacilityInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.facilityList = data;
            });
        },


        getSupportDropdown(uri = '/organization/getSupportInDropdown'){
            axios.get(uri)
            .then(response => {
                let data = response.data;
                this.supportList = data;
            });
        },
    },
     mounted() { 
        this.getFacilityDropdown();
        this.getSupportDropdown();
    }
}
</script>