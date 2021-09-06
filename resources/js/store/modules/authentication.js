const authentication = {
    namespaced: true,

    state: () => ({
        selectedAuthentication: null,
        authentication: null
    }),

    mutations: {
        setAuthentication(state, payload) {
            state.authentication = payload;
        },
        addAuthentication(state, payload) {
            state.authentication.push(payload);
        },
        updateAuthentication(state, payload) {
            const index = _.findIndex(state.authentication, function(o) {
                return o.id == payload.id;
            });
            state.authentication.splice(index, 1, payload);
        }
    },

    actions: {
        async setAuthentication(state) {
            await axios.get("/creds/").then(e => {
                state.commit("setAuthentication", e.data);
            });
        },
        updateAuthentication(state, payload) {
            state.commit("updateAuthentication", payload);
        },
        addAuthentication(state, payload) {
            state.commit("addAuthentication", payload);
        }
    },

    getters: {
        getCreds(state) {
            return state.authentication;
        }
    }
};
export default authentication;
