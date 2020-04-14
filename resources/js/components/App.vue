<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    import DoctorHome from "./Doctor/DoctorHome";
    import PatientHome from "./Patient/PatientHome";

    export default {
        props: ['is_doctor'],
        components: {
            DoctorHome,
            PatientHome
        }
    }
</script>
