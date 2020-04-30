<template>
    <div class="col-2">
        <h3>Your Patients
            <RouterLink to="/add-patient">
                <button class="btn btn-outline-success  mb-3 float-right">Add New <i class="fa fa-plus"></i></button>
            </RouterLink>
        </h3>
        <div class="clearfix"></div>
        <ul v-if="patients.length" class="list-group list-unstyled">
            <li v-bind:key="patient.id" v-for="patient in patients" class="list-group-item list-group-item-action cursor-pointer p-0">
                <RouterLink :to="'/patient/'+patient.id" class="d-block p-2 text-secondary" active-class="active">
                    {{ patient.name }}
                </RouterLink>
            </li>
        </ul>
        <div v-else>
            <p class="text-center">No patients added yet.</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PatientList",
        computed: {
            patients() {
                return this.$store.getters.getPatients
            }
        }
    }
</script>

<style scoped>

</style>
