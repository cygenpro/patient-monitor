<template>
    <div class="col-9 table-responsive">
        <table class="table table-striped">
            <thead class="bg-success text-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Cough</th>
                    <th scope="col">Sore throat</th>
                    <th scope="col">Diarrhea</th>
                    <th scope="col">Tiredness</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "PatientRecords",
        props: ['records']
    }
</script>

<style scoped>

</style>
