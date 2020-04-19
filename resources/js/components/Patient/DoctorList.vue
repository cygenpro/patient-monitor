<template>
    <div class="col-2">
        <h3>Doctors
            <RouterLink to="/new-record">
                <button class="btn btn-outline-success mb-3 float-right">Submit New Record <i class="fa fa-plus"></i></button>
            </RouterLink>
        </h3>
        <div class="clearfix"></div>
        <ul v-if="doctors.length" class="list-group list-unstyled">
            <li v-bind:key="doctor.id" v-for="doctor in doctors" class="list-group-item list-group-item-action cursor-pointer p-0">
                <RouterLink :to="'/doctor/'+doctor.id" class="d-block p-2 text-secondary" active-class="active">
                    {{ doctor.name }}
                </RouterLink>
            </li>
        </ul>
        <div v-else>
            <p class="text-center">No doctors assigned yet.</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DoctorList",
        computed: {
            doctors() {
                return this.$store.getters.getDoctors
            }
        }
    }
</script>

<style scoped>

</style>
