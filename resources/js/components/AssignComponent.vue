<template>
  <div class="card">
    <div class="card-header">User Approval</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Credential</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(usr, inx) in users" :key="inx">
              <th scope="row">{{ inx + 1 }}</th>
              <td>name</td>
              <td>email</td>
              <td>
                <select
                  style="min-width: 150px"
                  class="form-select"
                  aria-label="Default select example"
                >
                  <option selected>Open this select menu</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </td>
              <td class="d-flex action-container">
                <button class="btn btn-outline-primary">Assign</button>
                <button class="btn btn-outline-success">Active</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    users: null,
    creds: null,
  }),
  methods: {
    assign() {
      axios
        .post("/assign", {
          user: 1,
          cred: 1,
          active: true,
        })
        .then((e) => {});
    },
  },
  beforeMount() {
    axios.get("/assign").then((e) => {
      //   this.users = e.data;
      console.log(e.data);
      this.users = e.data.users;
      this.creds = e.data.creds;
    });
  },
};
</script>
<style lang="scss" scoped>
.action-container {
  justify-content: space-evenly;
}
</style>