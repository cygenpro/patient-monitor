<template>
    <div class="col-2">
        <doctor-request></doctor-request>
        <h3>Doctors
            <RouterLink v-if="doctors.length" :to="this.newRecordRoute()">
                <button class="btn btn-outline-success mb-3 float-right">New Record <i class="fa fa-plus"></i></button>
            </RouterLink>
        </h3>
        <div v-if="doctors.length" class="clearfix"></div>
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
    import DoctorRequest from "./DoctorRequest";
    export default {
        name: "DoctorList",
        components: {DoctorRequest},
        props: ['chosen_doctor'],
        data() {
            return {
                newRecordRoute: function () {
                    let route = '/new-record';

                    if( this.chosen_doctor ) {
                        let params = '?doctor_id=' + this.chosen_doctor;

                        route += params;
                    }

                    return route;
                }
            }
        },
        computed: {
            doctors() {
                return this.$store.getters.getDoctors
            }
        }
    }
</script>

<style scoped>

</style>
