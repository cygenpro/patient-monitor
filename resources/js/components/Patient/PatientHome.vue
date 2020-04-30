<template>
    <div>
        <div class="row mb-4">
            <doctor-list :chosen_doctor="$route.params.id"></doctor-list>
            <patient-records :no_record_message="'Please select a doctor from your doctors list to view reported records.'">
            </patient-records>
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
    import DoctorList from "./DoctorList";
    import PatientRecords from "../PatientRecords";
    import LineChart from "../Charts/LineChart";
    import PolarChart from "../Charts/PolarChart";
    import axios from "axios";

    export default {
        name: "PatientHome",
        components: {PolarChart, LineChart, PatientRecords, DoctorList},
        watch: {
            $route (to, from){
                this.updateRecords(to.params.id);
            }
        },
        methods: {
            updateRecords: function (doctorId) {
                axios.get('/patient/doctor/'+doctorId)
                    .then((response) => {
                        this.$store.dispatch('setRecords', {
                            records: response.data.records
                        })
                    })
            }
        },
        created() {
            let patientId = this.$route.params.id;

            if(patientId) {
                this.updateRecords(patientId);

                setInterval(() => {
                    axios.get('/patient/pending-request')
                        .then((response) => {
                            if(response.data.doctorRequest) {
                                this.$store.dispatch('setDoctorRequest', {
                                    doctorRequest: response.data.doctorRequest
                                })
                            }
                        })
                }, 7000);
            }
        }
    }
</script>

<style scoped>

</style>
