import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        patients: JSON.parse(window.authUser.patients),
        doctors: JSON.parse(window.authUser.doctors),
        records: [],
        doctorRequest: null
    },
    getters: {
        getPatients: state => {
            return state.patients;
        },
        getDoctors: state => {
            return state.doctors;
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
               data.temperature.labels.unshift(item.created_at);
               data.temperature.values.unshift(item.temperature);

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
        },
        getDoctorRequest: state => {
            return state.doctorRequest;
        }
    },
    mutations: {
        setRecords: (state, payload) => {
            state.records = payload;
        },
        addPatient: (state, payload) => {
            state.patients.unshift(payload);
        },
        addDoctor: (state, payload) => {
           state.doctors.unshift(payload);
        },
        setDoctorRequest: (state, payload) => {
            state.doctorRequest = payload;
        }
    },
    actions: {
        setRecords: ({commit}, payload) => {
            commit('setRecords', payload.records);
        },
        addPatient: ({commit}, payload) => {
            commit('addPatient', payload.patient);
        },
        addDoctor: ({commit}, payload) => {
            commit('addDoctor', payload.doctor);
        },
        setDoctorRequest: ({commit}, payload) => {
            commit('setDoctorRequest', payload.doctorRequest);
        },
    }
});
