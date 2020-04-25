<template>
    <div class="border border-success p-3 mb-3" v-if="doctorRequest">
        <div class="clearfix"></div>
        <div class="mb-2 text-center">
            <p class="text-success"><i class="fa fa-2x fa-bell-o"></i></p>
            <p>
                Doctor <strong>{{ doctorRequest.doctor_name }}</strong> wants to add you to his patients list.
            </p>
            <p>
                Accept the request to be able share him or her records.
            </p>
            <button @click="acceptRequest()" class="btn btn-outline-success"><i class="fa fa-check"></i> Accept</button>
            <button @click="declineRequest()" class="btn btn-outline-danger"><i class="fa fa-times"></i> Decline</button>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "DoctorRequest",
        computed: {
            doctorRequest: {
                get: function() {
                    return this.$store.getters.getDoctorRequest
                },
                set: function(value) {
                    this.$store.dispatch('setDoctorRequest', {
                        doctorRequest: value
                    })
                }
            },
        },
        methods: {
            acceptRequest: function() {
                let doctorId = this.doctorRequest.doctor_id;

                this.doctorRequest = null;

                axios.put('/patient/request/accept', {
                    "doctor_id": doctorId
                })
                    .then((response) => {
                        this.getDoctorRequest();
                        this.$store.dispatch('addDoctor', {
                            doctor: response.data.doctor
                        });
                    })
                    .catch(function (error) {
                        // console.log(error);
                    });
            },
            declineRequest: function() {
                let doctorId = this.doctorRequest.doctor_id;

                this.doctorRequest = null;

                axios.put('/patient/request/decline', {
                    doctor_id: doctorId
                })
                    .then((response) => {
                        this.getDoctorRequest();
                    })
                    .catch(function (error) {
                        // console.log(error);
                    });
            },
            getDoctorRequest: function () {
                axios.get('/patient/pending-request')
                    .then((response) => {
                        this.$store.dispatch('setDoctorRequest', {
                            doctorRequest: response.data.doctorRequest
                        })
                    })
                    .catch(function (error) {
                        // console.log(error
                    })
            }
        },
        mounted() {
            this.getDoctorRequest();
        }
    }
</script>

<style scoped>

</style>
