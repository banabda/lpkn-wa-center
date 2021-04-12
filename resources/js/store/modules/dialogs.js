import axios from "axios";

const dialogs = {
    namespaced: true,

    state: () => ({
        dialog_list: null,
        search_list: null,
        search: "",
        selectedDialog: null
    }),

    mutations: {
        setDialogs(state, payload) {
            state.dialog_list = payload;
        },
        searchDialog(state, payload) {
            state.search_list = payload;
        },
        setSearch(state, payload) {
            state.search = payload;
        },
        setSearchList(state, payload) {
            state.search_list = payload;
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
        },
        searchDialog(state, key) {
            if (key != "" && !/^\s+$/.test(key)) {
                axios.get("/chat/contact/search/" + key).then(e => {
                    state.commit("searchDialog", e.data);
                });
            } else {
                state.commit("searchDialog", null);
            }
        }
    },

    getters: {
        getDialogs(state) {
            return state.dialog_list;
        },
        getSearchedDialogs(state) {
            return state.search_list;
        },
        getSelectedDialogs(state) {
            return state.selectedDialog;
        }
    }
};
export default dialogs;
