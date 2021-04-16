<template>
  <div class="card">
    <div class="card-header">User Approval</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
            <tr class="text-center">
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
              <td>{{ usr.name }}</td>
              <td>{{ usr.email }}</td>
              <td>
                <select
                  style="min-width: 150px"
                  class="form-select"
                  aria-label="Default select example"
                  :key="inx"
                >
                  <option selected>Select Credential</option>
                  <option selected :value="cred.id">
                    {{ cred }}
                  </option>
                  <option :value="cred.id" v-for="cred in creds" :key="cred.id">
                    {{ cred.name }}
                  </option>
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
    selectedVal: {
      parent_id: [],
    },
  }),
  methods: {
    updateCountry(person, country) {
      person.country = country;
    },
    getValue(e) {
      console.log(e);
    },
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