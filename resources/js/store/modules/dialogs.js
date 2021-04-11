const dialogs = {
    namespaced: true,

    state: () => ({
        dialog_list: null,
        selectedDialog: null
    }),

    mutations: {
        setDialogs(state, payload) {
            state.dialog_list = payload;
        },
        setSelectedDialog(state, payload) {
            if (payload == null) {
                state.selectedDialog = null;
            } else {
                state.selectedDialog = {};
                state.selectedDialog.id = payload.id;
                state.selectedDialog.name = payload.name;
                state.selectedDialog.image = payload.image;
                state.selectedDialog.isGroup = payload.is_group;
                state.selectedDialog.lastTime = payload.last_time;
            }
        }
    },

    actions: {
        async setDialogs(state) {
            await axios.get("/chat/contact").then(e => {
                const list = _.sortBy(e.data, [
                    function(o) {
                        return o.latest_message.time;
                    }
                ]).reverse();
                state.commit("setDialogs", list);
            });
        },
        setSelectedDialog(state, user) {
            state.commit("setSelectedDialog", user);
        }
    },

    getters: {
        getDialogs(state) {
            return state.dialog_list;
        },
        getSelectedDialogs(state) {
            return state.selectedDialog;
        }
    }
};
export default dialogs;
