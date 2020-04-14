<template>
    <div class="row justify-content-center">
        <div class="col-md-3 col">
            <h3 class="text-center">Add New Patient</h3>
            <br>
            <div v-if="!message.length">
                <label for="phone">Patient Phone Number</label>
                <div class="form-group">
                    <input v-model="phone" @input="clearError" type="text" class="form-control text-center" id="phone" name="phone" placeholder="E.g. +1987654320" autocomplete="off" />
                    <span v-if="this.error.length > 0" class="text-danger text-center d-block mt-1">{{ this.error }}</span>
                </div>
                <div class="form-group text-center">
                    <button @click="addPatient" class="btn btn-outline-success">Add <i class="fa fa-plus"></i></button>
                    <RouterLink to="/"><button class="btn btn-link text-danger">Cancel <i class="fa fa-times"></i></button></RouterLink>
                </div>
            </div>
            <div v-else>
                <p class="text-center">{{ this.message }}</p>
                <div class="form-group text-center">
                    <button @click="clearPropValues" class="btn btn-outline-success">Add Another Patient <i class="fa fa-plus"></i></button>
                    <RouterLink to="/"><button class="btn btn-link text-danger">Go Home <i class="fa fa-times"></i></button></RouterLink>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "AddPatient",
        data() {
            return {
                phone: '',
                message: '',
                error: ''
            }
        },
        methods: {
            addPatient: function() {
                axios.post('/doctor/add-patient', {
                    phone: this.phone
                })
                    .then((response) => {
                        this.message = response.data.message;
                    })
                    .catch((error) => {
                        this.error = error.response.data.message;
                    });
            },
            clearPropValues: function () {
                this.message = '';
                this.phone = '';
                this.error = '';
            },
            clearError: function () {
                this.error = '';
            }
        }
    }
</script>

<style scoped>

</style>
