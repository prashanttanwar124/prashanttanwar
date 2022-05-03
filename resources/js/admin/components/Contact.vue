<template>
  <div class>
    <div class="uk-flex-middle uk-margin-medium-bottom" uk-grid>
      <div class="uk-width-1-2">
        <div class="uk-flex uk-flex-right">

        </div>
      </div>
      <div class="uk-width-1-2 uk-flex-first">
        <div>
          <h4 class="uk-h4 uk-margin-remove">Contact Data Table</h4>
        </div>
      </div>
    </div>

    <template v-if="loading_data">
      <vs-alert hidden-content>
        <template #title>
          <div class="uk-text-capitalize">please wait data is loading</div>
        </template>
      </vs-alert>
    </template>

    <div v-else class="uk-card uk-card-body uk-card-default uk-card-small uk-border-rounded">
      <vs-table notFound>
        <template #header>
          <vs-input v-model="search" border placeholder="Search" />
        </template>
        <template #thead>
          <vs-tr>
            <vs-th sort @click="
                                allData = $vs.sortData(
                                    $event,
                                    allData,
                                    'id'
                                )
                            ">Id</vs-th>
            <vs-th>Name</vs-th>
            <vs-th>User Phone</vs-th>
            <vs-th>Submit At</vs-th>
            <vs-th>Action</vs-th>
          </vs-tr>
        </template>
        <template #tbody>
          <vs-tr :key="i" v-for="(tr, i) in $vs.getPage(
                            $vs.getSearch(allData, search),
                            page,
                            max
                        )" :data="tr">
            <vs-td>{{ tr.id }}</vs-td>
            <vs-td>{{ tr.name }}</vs-td>
            <vs-td>{{ tr.phone_number }}</vs-td>
            <vs-td>{{ tr.created_at | formatDate }}</vs-td>
            <vs-td>
              <div class="uk-grid-divider uk-grid-small" style="width:152px" uk-grid>
                <div>
                  <vs-button @click="btnConfig(tr, 0)" success circle icon floating>
                    <i class='bx bx-expand-alt'></i>
                  </vs-button>
                </div>
              </div>
            </vs-td>
          </vs-tr>
        </template>
        <template #footer>
          <vs-pagination v-model="page" :length="
                            $vs.getLength(
                                $vs.getSearch(allData, search),
                                max
                            )" />
        </template>
      </vs-table>
    </div>

    <!-- #### Model #### -->

    <vs-dialog overflow-hidden not-center v-model="activeModel">
      <div class="uk-card-title uk-margin-small-top uk-card-body uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
        {{
        editBtn
        ? "Edit Contact"
        : deleteBtn
        ? "Delete Contact"
        : "Create Contact"
        }}
      </div>
      <hr />

      <div class="uk-card-body uk-margin-small-top uk-width-large uk-margin-medium-top uk-padding-remove-top uk-padding-remove-bottom">
        <vs-input v-model="form.name" label-placeholder="Name" :readonly="deleteBtn">
          <template #message-danger>
            <has-error :form="form" field="name"></has-error>
          </template>
        </vs-input>

        <div class="uk-margin-medium-top">
          <vs-input v-model="form.phone_number" label-placeholder="Phone Number" :readonly="deleteBtn">
            <template #message-danger>
              <has-error :form="form" field="phone_number"></has-error>
            </template>
          </vs-input>
        </div>

        <div class="uk-margin-medium-top">
          <vs-input v-model="form.message" label-placeholder="Message" :readonly="deleteBtn">
            <template #message-danger>
              <has-error :form="form" field="message"></has-error>
            </template>
          </vs-input>
        </div>

      </div>

      <hr class="uk-margin-medium-top" />

      <div class="uk-card-title uk-margin-small-top uk-card-body uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
        <div class="uk-flex uk-flex-right">
          <vs-button success v-if="editBtn" @click="editData" :loading="form.busy" :active="form.busy">Edit Data</vs-button>
          <vs-button danger v-else-if="deleteBtn" @click="deleteData" :loading="form.busy" :active="form.busy">Delete Data</vs-button>

          <vs-button v-else-if="submitBtn" @click="submitForm" :loading="form.busy" :active="form.busy">Submit Data</vs-button>
        </div>
      </div>
    </vs-dialog>
    <!-- #### Model #### -->
  </div>
</template>
<script>
export default {
  data: () => ({
    form: new Form({
      id: "",
      name: "",
      phone_number: "",
      message: ""
    }),

    search: "",
    page: 1,
    max: 6,
    submitBtn: false,
    editBtn: false,
    deleteBtn: false,
    activeModel: false,
    allData: null,
    loading_data: true
  }),
  methods: {
    getData() {
      axios
        .get("/data/contact")
        .then(res => {
          this.allData = res.data;
          this.loading_data = false;
        })
        .catch(err => {
          this.openNotification();
        });
    },
    submitForm() {
      //   this.form
      //     .post("/data/contact")
      //     .then(res => {
      //       this.form.reset();
      //       this.activeModel = false;
      //       this.getData();
      //     })
      //     .catch(err => {
      //       this.openNotification();
      //     });
    },
    editData() {
      //   this.form
      //     .put(`/data/contact/${this.form.id}`)
      //     .then(res => {
      //       this.form.reset();
      //       this.activeModel = false;
      //       this.getData();
      //     })
      //     .catch(err => {
      //       this.openNotification();
      //     });
    },
    deleteData() {
      this.form
        .delete(`/data/contact/${this.form.id}`)
        .then(res => {
          this.form.reset();
          this.activeModel = false;
          this.getData();
        })
        .catch(err => {
          this.openNotification();
        });
    },
    btnConfig(tr, btnType) {
      this.form.fill(tr);
      this.form.clear();
      this.activeModel = true;

      if (btnType === 0) {
        this.deleteBtn = true;
        this.editBtn = false;
        this.submitBtn = false;
      }

      if (btnType === 1) {
        this.editBtn = true;
        this.deleteBtn = false;
        this.submitBtn = false;
      }
    },
    addNew() {
      this.form.reset();
      this.form.clear();
      this.activeModel = true;
      this.submitBtn = true;
      this.editBtn = false;
      this.deleteBtn = false;
    },
    openNotification() {
      const noti = this.$vs.notification({
        color: `danger`,
        duration: 8000,
        progress: "auto",
        position: "bottom-left",
        title: "<i class='bx bxs-bug' ></i> There Is Some Error.",
        text: `Check Your Input Fields Or Your Internet Connection And Try Again.`
      });
    }
  },
  created() {
    this.getData();
  }
};
</script>


