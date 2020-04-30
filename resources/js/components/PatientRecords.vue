<template>
    <div class="col-md-10 col-12 table-responsive">
        <datatable :columns="columns" :data="rows" :per-page="5"></datatable>
        <datatable-pager v-model="page" type="abbreviated"></datatable-pager>
    </div>
</template>

<script>
    import Vue from 'vue';
    import { VuejsDatatableFactory } from 'vuejs-datatable';

    Vue.use( VuejsDatatableFactory );

    VuejsDatatableFactory.useDefaultType( false )
        .registerTableType( 'datatable', tableType => tableType.mergeSettings( {
            table: {
                class:   'table table-hover table-striped text-left',
                sorting: {
                    sortAsc:  '<i class="fa fa-sort-amount-asc" title="Sort ascending"></i>',
                    sortDesc: '<i class="fa fa-sort-amount-desc" title="Sort descending"></i>',
                    sortNone: '<i class="fa fa-sort" title="Sort"></i>',
                },
            },
            pager: {
                classes: {
                    pager:    'pagination text-center',
                    selected: 'active',
                },
                icons: {
                    next:     '<i class="fa fa-chevron-right" title="Next page"></i>',
                    previous: '<i class="fa fa-chevron-left" title="Previous page"></i>',
                },
            },
        } ) );

    export default {
        name: "PatientRecords",
        data() {
            return {
                columns: this.$store.getters.getRecords.columns,
            }
        },
        computed: {
            rows() {
                return this.$store.getters.getRecords.rows;
            }
        }
    }
</script>

<style>
    thead {
        background: #38c172;
        color: #fff;
    }

    .pagination li {
        margin: 5px;
        padding: 5px 10px;
    }

    .pagination li.active {
        background: #3490dc;
        color: #fff;
    }
</style>
