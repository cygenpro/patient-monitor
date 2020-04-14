<template>
    <div class="col-3">
        <h3>Patient List
            <router-link
                to="/add-patient"
            >
                <button class="btn btn-outline-success btn-sm mb-3 float-right">Add New Patient <i class="fa fa-plus"></i></button>
            </router-link>
        </h3>
        <div class="clearfix"></div>
        <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                Cras justo odio
                <span class="badge badge-primary badge-pill">2</span>
            </a>
            <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
            <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
            <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
            <a href="#" class="list-group-item list-group-item-action">Vestibulum at eros</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PatientList",
    }
</script>

<style scoped>

</style>
