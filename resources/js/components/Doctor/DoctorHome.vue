<template>
    <div class="row">
        <patient-list></patient-list>
        <patient-records></patient-records>
    </div>
</template>

<script>
    import PatientList from "./PatientList";
    import PatientRecords from "./PatientRecords";

    export default {
        name: "DoctorHome",
        components: {PatientRecords, PatientList}
    }
</script>

<style scoped>

</style>
