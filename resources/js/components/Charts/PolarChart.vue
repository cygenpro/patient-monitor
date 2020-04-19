<script>
    import {PolarArea} from 'vue-chartjs';

    export default {
        name: "PolarChart",
        extends: PolarArea,
        props: ['labels', 'values'],
        mounted () {
            this.updateChart();
        },
        methods: {
            updateChart: function () {
                this.renderChart({
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Temperature',
                            backgroundColor: '#f88f89',
                            data: this.values
                        }
                    ]
                })
            }
        },
        watch: {
            labels: function(to, from) {
                this.labels = to;
                this.updateChart();
            },

            values: function(to, from) {
                this.values = to;
                this.updateChart();
            }
        }
    }
</script>

<style scoped>

</style>
