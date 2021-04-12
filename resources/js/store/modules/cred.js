const cred = {
    namespaced: true,

    state: () => ({
        name: null,
        phone: null,
        chatId: null,
        instance: null,
        token: null
    }),

    mutations: {
        setCred(state, payload) {
            state.name = payload.name;
            state.phone = payload.phone;
            state.chatId = payload.chatId;
            state.instance = payload.instance;
            state.token = payload.token;
        }
    },

    actions: {
        async setCred(state) {
            await axios.get("/credential/getcred").then(e => {
                state.commit("setCred", e.data.credential);
            });
        }
    },

    getters: {
        getCred(state) {
            return state;
        }
    }
};
export default cred;
