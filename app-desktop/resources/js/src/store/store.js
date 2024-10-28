import { createStore } from 'vuex';
//import module

const store = createStore({

    modules: {
        //object: module
    },

	state() {
		return {
			message: '',
            errors: null,
            shows: [],
		};
	},
    getters: {
        /*doubleCount(state) {
            return state.count*2
        }*/
    },
    mutations: {
        defaultDataParamsMsgErrs(state, newParamMsg, newParamErrs) {
            state.message = newParamMsg
            state.errors = newParamErrs
        },

        addDataToShows(state, newParams) {

            state.shows.push( { 'show': newParams.show, 'category': newParams.category } )

        },

    },
    actions: {
        getNewParamsMsgErrs({ state, commit, getters }) {
            commit('defaultDataParamsMsgErrs', '', null)
        },
    },
});

export default store;