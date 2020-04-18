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
