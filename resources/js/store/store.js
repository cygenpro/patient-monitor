import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        patients: window.authUser.patients,
        records: []
    },
    getters: {
        getPatients: state => {
            return JSON.parse(state.patients)
        },
        getRecords: state => {
            return state.records;
        },
        getChartData: state => {
            let data = {
                'temperature': {
                    'labels' : [],
                    'values' : []
                },
                'symptoms': {
                    'labels' : ['Cough', 'Hard breath', 'Sore throat', 'Diarrhea', 'Tiredness'],
                    'values': {
                        'cough' : 0,
                        'hard_breath' : 0,
                        'sore_throat' : 0,
                        'diarrhea' : 0,
                        'tiredness' : 0
                    }
                }
            };

            state.records.forEach(function(item, index) {
               data.temperature.labels.push(item.created_at);
               data.temperature.values.push(item.temperature);

               if(item.has_cough) {
                   data.symptoms.values.cough++;
               }

               if(item.has_hard_breath) {
                   data.symptoms.values.hard_breath++;
               }

               if(item.has_sore_throat) {
                   data.symptoms.values.sore_throat++;
               }

               if(item.has_diarrhea) {
                   data.symptoms.values.diarrhea++;
               }

               if(item.has_tiredness) {
                   data.symptoms.values.tiredness++;
               }
            });

            let values = [];

            for (let [key, value] of Object.entries(data.symptoms.values)) {
               values.push(value);
            }

            data.symptoms.values = values;

            return data;
        }
    },
    mutations: {
        setRecords: (state, payload) => {
            state.records = payload;
        }
    },
    actions: {
        setRecords: ({commit}, payload) => {
            commit('setRecords', payload.records);
        }
    }
});
