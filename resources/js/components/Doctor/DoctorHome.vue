<template>
    <div>
        <div class="row mb-4">
            <patient-list></patient-list>
            <patient-records :no_record_message="'Please select a patient from your patient list to view his or her records.'"></patient-records>
        </div>
        <div class="row justify-content-center">
            <line-chart
                :label="'Temperature'"
                :labels="$store.getters.getChartData.temperature.labels"
                :values="$store.getters.getChartData.temperature.values">
            </line-chart>
            <polar-chart
                :labels="$store.getters.getChartData.symptoms.labels"
                :values="$store.getters.getChartData.symptoms.values">
            </polar-chart>
        </div>
    </div>
</template>

<script>
    import PatientList from "./PatientList";
    import PatientRecords from "../PatientRecords";
    import axios from "axios";
    import LineChart from "../Charts/LineChart";
    import PolarChart from "../Charts/PolarChart";

    export default {
        name: "DoctorHome",
        components: {PolarChart, LineChart, PatientRecords, PatientList},
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

                setInterval(() => {
                    axios.get('/doctor/patient/'+patientId+'/new-records')
                        .then((response) => {
                            if(response.data.records) {
                                response.data.records.forEach((item, index) => {
                                    this.$store.dispatch('appendRecord', {
                                        record: item
                                    })
                                });
                            }
                        })
                }, 5000);
            }
        },
        created() {
            let patientId = this.$route.params.id;

            if(patientId) {
                this.updateRecords(patientId);
            }
        }
    }
</script>

<style scoped>

</style>
