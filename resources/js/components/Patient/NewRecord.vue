<template>
    <div>
        <div class="row mb-4">
            <div class="col">
                <h3 class="text-center text-success">Submit New Record</h3>
            </div>
        </div>
        <div class="row justify-content-center mb-3">
            <div class="col col-md-5 text-right">
                <div class="form-group justify-content-center">
                    <label for="doctors">Choose doctor(s)</label>
                    <br>
                    <select v-model="record.doctors" id="doctors" class="form-control text-center col col-md-6 d-inline-block" multiple>
                        <option v-for="doctor in doctors" :value="doctor.id" :key="doctor.name">{{ doctor.name }}</option>
                    </select>
                    <p v-if="showDoctorsError" class="text-danger">Please choose at least one doctor <i class="fa fa-exclamation text-danger"></i></p>
                </div>
                <div class="form-group mb-3">
                    <label for="temperature">Temperature</label><br>
                    <input v-model="record.temperature" type="number" step="0.1" class="form-control has-error text-center col col-md-4 d-inline-block" id="temperature" placeholder="Your body temperature...">
                    <p v-if="showTemperatureError" class="text-danger">Please specify your body temperature <i class="fa fa-exclamation text-danger"></i></p>
                </div>
            </div>
            <div class="col col-md-5 text-left">
                <label for="">Select symptoms if you have any</label>
                <br>
                <div class="col col-md-3 d-inline-block">
                    <div class="custom-control text-left custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" v-model="record.symptoms" value="has_cough" id="has_cough">
                        <label class="custom-control-label" for="has_cough">Cough</label>
                    </div>
                    <div class="custom-control text-left custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" v-model="record.symptoms" value="has_hard_breath" id="has_hard_breath">
                        <label class="custom-control-label" for="has_hard_breath">Hard breath</label>
                    </div>
                    <div class="custom-control text-left custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" v-model="record.symptoms" value="has_sore_throat" id="has_sore_throat">
                        <label class="custom-control-label" for="has_sore_throat">Sore throat</label>
                    </div>
                    <div class="custom-control text-left custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" v-model="record.symptoms" value="has_diarrhea" id="has_diarrhea">
                        <label class="custom-control-label" for="has_diarrhea">Diarrhea</label>
                    </div>
                    <div class="custom-control text-left custom-checkbox mb-1">
                        <input type="checkbox" class="custom-control-input" v-model="record.symptoms" value="has_tiredness" id="has_tiredness">
                        <label class="custom-control-label" for="has_tiredness">Tiredness</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-group mt-4">
                <button @click="submitRecord" class="btn btn-outline-success">Submit Record</button>
                <RouterLink :to="this.getBackUrl()"><button class="btn btn-link text-danger">Cancel <i class="fa fa-times"></i></button></RouterLink>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "NewRecord",
        data() {
            return {
                doctors: this.$store.getters.getDoctors,
                showTemperatureError: false,
                showDoctorsError: false,
                record: {
                    doctors: this.getDoctors(),
                    temperature: '',
                    symptoms: []
                }
            }
        },
        methods: {
            submitRecord: function () {
                if(this.validate()) {
                    axios.post('/patient/record', {
                        doctors: this.record.doctors,
                        temperature: this.record.temperature,
                        symptoms: this.record.symptoms
                    })
                        .then((response) => {
                            let url = this.getBackUrl() === '/' ? '/doctor/'+this.record.doctors[0] : this.getBackUrl();

                            this.$router.push(url);
                        })
                        .catch(function (error) {
                            // console.log(error);
                        });
                }
            },
            validate: function () {
                // todo: get rid of this mess and implement validation with Vuelidate

                let isValid = true;

                if(!this.record.doctors.length) {
                    isValid = false;
                    this.showDoctorsError = true;
                } else {
                    this.showDoctorsError = false;
                }

                if(!this.record.temperature.length) {
                    isValid = false;
                    this.showTemperatureError = true;
                } else {
                    this.showTemperatureError = false;
                }

                return isValid;
            },
            getDoctors: function () {
                let ar = [];

                if( this.$route.query.doctor_id ) {
                    ar.push(this.$route.query.doctor_id);
                }

                return ar;
            },
            getBackUrl: function () {
                return this.$route.query.doctor_id ? '/doctor/'+this.$route.query.doctor_id : '/';
            }
        }
    }
</script>

<style scoped>

</style>
