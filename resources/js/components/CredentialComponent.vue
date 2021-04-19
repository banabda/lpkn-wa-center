<template>
  <div class="credential">
    <EditCredential />
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">ChatId</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(cre, inx) in creds" :key="inx">
                <th scope="row">{{ inx + 1 }}</th>
                <td>{{ cre.name }}</td>
                <td>{{ cre.chatId }}</td>
                <td>{{ cre.phone }}</td>
                <td>
                  <button class="btn btn-info" @click="edit">edit</button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="grid">
          <div class="btn btn-outline-primary">add</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import EditCredential from "./modals/editCredential";
export default {
  components: { EditCredential },
  props: {
    creds: { require: true },
  },
  methods: {
    edit() {
      this.$modal.show("edit-credential");
    },
  },
};
</script>
<style lang="scss" scoped>
.grid {
  display: grid;
  place-items: end;
}
</style>