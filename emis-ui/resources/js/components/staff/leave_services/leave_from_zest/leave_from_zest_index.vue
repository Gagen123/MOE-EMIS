<template>
    <div>
        <div class="card card-primary card-outline">
            <div class="card-header pb-1 mb-0 pt-0 mt-0 bg-white">
                <span class="card-title">
                    <b>Leave from Zest</b>
                </span>
                <span class="fa-pull-right pt-1">
                    <button type="button" class="btn btn-primary text-white btn-sm" @click="showadprocess('leave_from_zest')" id="listleavebtn"><i class="fa fa-list"></i> List</button>
                    <button type="button" class="btn btn-dark text-white btn-sm" id="addleavebtn"><i class="fa fa-sync"></i> Sync</button>
                </span>
            </div>
            <div class="card-body pb-1 mb-0 pt-1 mt-0">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>


