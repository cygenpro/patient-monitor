<template>
    <div class="col-10 table-responsive">
        <table class="table table-striped text-center" id="records-table">
            <thead class="bg-success text-light">
                <tr>
                    <th scope="col">Temperature</th>
                    <th scope="col">Cough</th>
                    <th scope="col">Hard Breath</th>
                    <th scope="col">Sore throat</th>
                    <th scope="col">Diarrhea</th>
                    <th scope="col">Tiredness</th>
                    <th scope="col">Created at</th>
                </tr>
            </thead>
            <tbody v-if="records.length">
                <tr v-for="record in records">
                    <td><span :class="record.temperature > 37 ? 'text-danger' :'text-success'"><strong>{{ record.temperature }}</strong></span></td>
                    <td><i :class="!record.has_cough ? 'fa fa-minus text-success' : 'fa fa-plus text-danger'"></i></td>
                    <td><i :class="!record.has_hard_breath ? 'fa fa-minus text-success' : 'fa fa-plus text-danger'"></i></td>
                    <td><i :class="!record.has_sore_throat ? 'fa fa-minus text-success' : 'fa fa-plus text-danger'"></i></td>
                    <td><i :class="!record.has_diarrhea ? 'fa fa-minus text-success' : 'fa fa-plus text-danger'"></i></td>
                    <td><i :class="!record.has_tiredness ? 'fa fa-minus text-success' : 'fa fa-plus text-danger'"></i></td>
                    <td>{{ record.created_at }}</td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="8" class="text-secondary">
                        {{ this.no_record_message }} <i class="fa fa-exclamation text-danger"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "PatientRecords",
        props: ['no_record_message'],
        computed: {
            records() {
                return this.$store.getters.getRecords
            }
        }
    }
</script>

<style scoped>

</style>
