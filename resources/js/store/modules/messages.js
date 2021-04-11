const messages = {
    namespaced: true,

    state: () => ({
        messages: null
    }),

    mutations: {
        setMessages(state, payload) {
            state.messages = payload;
        },
        sendMessage(state, payload) {
            state.messages.push(payload);
        }
    },

    actions: {
        async setMessages(state, id) {
            await axios.get("/chat/contact/" + id).then(e => {
                const msg = e.data;
                state.commit("setMessages", msg);
            });
        },
        async getMessageByPage(state, page) {
            await axios.get("/chat/contact/" + page).then(e => {
                const msg = e.data;
                state.commit("setMessages", msg);
            });
        },
        sendMessage(state, payload) {
            // await axios.get("/chat-api/message/text").then(e => {
            //     const msg = e.data;
            //      payload.id = e.data.id
            // });
            state.commit("sendMessage", payload);
        }
    },

    getters: {
        getMessage(state) {
            return state.messages;
        }
    }
};
export default messages;
