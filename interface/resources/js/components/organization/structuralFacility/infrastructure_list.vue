<template>
    <div>
        <table id="infrastructure-table" class="table table-bordered text-sm table-striped">
            <thead>
                <tr>
                    <th>SL#</th>
                    <th>Category</th>
                    <th>Sub-Category</th>
                    <th>Structure No.</th>
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody id="tbody">
                <!-- <tr v-for="(item, index) in infrastructureList" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ item.category}}</td>
                    <td>{{ item.subCategory}}</td>
                    <td>{{ item.structureNo}}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#" class="btn btn-info" @click="viewDisasterList(item)"><i class="fas fa-edit"></i ></a>
                        </div>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
        return{
            
        }
    }
}
</script>