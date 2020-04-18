import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        patients: window.authUser.patients
    },
    getters: {
        getPatients: state => {
            return JSON.parse(state.patients)
        }
    }
});
