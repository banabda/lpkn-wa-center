const messages = {
    namespaced: true,

    state: () => ({
        messages: null,
        id: new Date(),
        time: new Date(),
        type: "document",
        caption: null,
        body: null,
        from_me: true,
        filename: null,
        chatId: null
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
        async sendMessage(state, payload) {
            await axios
                .post("/chat-api/message/text", {
                    body: payload.body,
                    chatId: payload.chatId,
                    instance: payload.instance,
                    token: payload.token
                })
                .then(e => {
                    // payload.id = e.data.id;
                });
            state.commit("sendMessage", payload);
        },
        async sendFile(state, payload) {
            await axios
                .post("/chat-api/message/file", {
                    url: payload.url,
                    filename: payload.name,
                    chatId: payload.chatId,
                    instance: payload.instance,
                    token: payload.token
                })
                .then(e => {
                    // payload.id = e.data.id;
                });
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
