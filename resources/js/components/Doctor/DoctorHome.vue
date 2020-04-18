<template>
    <div class="row">
        <patient-list></patient-list>
        <patient-records></patient-records>
    </div>
</template>

<script>
    import PatientList from "./PatientList";
    import PatientRecords from "./PatientRecords";
    import axios from "axios";

    export default {
        name: "DoctorHome",
        components: {PatientRecords, PatientList},
        watch:{
            $route (to, from){
                this.updateRecords(to.params.id);
            }
        },
        methods: {
            updateRecords: function (patientId) {
                axios.get('/doctor/patient/'+patientId)
                    .then((response) => {
                        this.$store.dispatch('setRecords', {
                            records: response.data.records
                        })
                    })
            }
        },
        created() {
            if(this.$route.params.id !== undefined) {
                this.updateRecords(this.$route.params.id);
            }
        }
    }
</script>

<style scoped>

</style>
