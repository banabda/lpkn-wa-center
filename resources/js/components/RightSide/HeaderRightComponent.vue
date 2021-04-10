<template>
  <div class="header">
    <div class="me d-flex px-4">
      <div class="right d-flex">
        <avatar
          :username="selected.name"
          :src="selected.image"
          :size="60"
          class="mr-3"
        ></avatar>
        <div class="name-container">
          <div class="name" v-if="selected">{{ selected.name }}</div>
          <div class="name" v-else>No User</div>
        </div>
      </div>
      <i class="bi bi-x" @click="selectedUser(null)"></i>
    </div>
  </div>
</template>
<script>
import Avatar from "vue-avatar";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
export default {
  components: {
    Avatar,
  },
  computed: {
    ...mapGetters({
      selected: "dialogs/getSelectedDialogs",
    }),
  },
  methods: {
    ...mapActions({
      selectedUser: "dialogs/setSelectedDialog",
    }),
  },
};
</script>
<style lang="scss" scoped>
.header {
  height: 10vh;
  .me {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-weight: bold;
    .right {
      align-items: center;
    }
    .name {
      font-size: 1.1rem;
    }
    .bi {
      font-size: 20px;
    }
    .bi:hover {
      cursor: pointer;
    }
  }
}
</style>