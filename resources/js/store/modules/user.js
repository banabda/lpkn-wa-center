import axios from "axios";

const user = {
    namespaced: true,

    state: () => ({
        email: "",
        name: "",
        role: ""
    }),

    mutations: {
        increment(state) {
            // state.count++;
        },
        setUser(state, payload) {
            state.email = payload.email;
            state.name = payload.name;
            state.role = payload.role[0];
        }
    },

    getters: {
        currentUser(state) {
            return state;
        }
    },

    actions: {
        async setUser(state) {
            await axios.get("/user/me").then(e => {
                state.commit("setUser", e.data);
            });
        }
    }
};
export default user;
