<template>
  <div class="search-left">
    <input
      type="text"
      class="search-input"
      placeholder="Search Contact"
      v-model="search"
      @change="searchName"
    />
  </div>
</template>
<script>
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  data: () => ({
    search: "",
  }),
  computed: {},
  methods: {
    ...mapMutations({
      setSearch: "dialogs/setSearch",
      setSearchList: "dialogs/setSearchList",
    }),
    ...mapActions({
      searchDialogs: "dialogs/searchDialog",
    }),
    searchName() {
      this.setSearch(this.search);
      //   this.searchDialogs(this.search);
      if (this.search != "" && !/^\s+$/.test(this.search)) {
        axios.get("/chat/contact/search/" + this.search).then((e) => {
          //   state.commit("searchDialog", e.data);
          this.setSearchList(e.data);
        });
      } else {
        // state.commit("searchDialog", null);
        this.setSearchList(null);
      }
    },
  },
};
</script>
<style lang="scss" scoped>
.search-left {
  padding: 10px 20px;
  height: 10vh;
  .search-input {
    width: 100%;
    border-radius: 8px;
    height: 6vh;
    border-color: black;
    border-width: 1px;
    padding: 0 8px;
  }
}
</style>