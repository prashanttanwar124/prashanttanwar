<template>
  <div class>
    <div class="uk-flex-middle uk-margin-medium-bottom" uk-grid>
      <div class="uk-width-1-2">
        <div class="uk-flex uk-flex-right">
          <vs-button style="width: 108px" @click="addNew">
            Add New
            <template #animate>
              <i class="bx bx-plus" style="font-size:22px"></i>
            </template>
          </vs-button>
        </div>
      </div>
      <div class="uk-width-1-2 uk-flex-first">
        <div>
          <h4 class="uk-h4 uk-margin-remove">Portfolio Table</h4>
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
                                )">Id</vs-th>
            <vs-th>Name</vs-th>
            <vs-th>Category Name</vs-th>
            <vs-th>Portfolio Image</vs-th>
            <vs-th>Position</vs-th>
            <vs-th>Created At</vs-th>
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
            <vs-td>{{ tr.category.category_name  }}</vs-td>
            <vs-td>
              <img :src="tr.portfolio_image" @click="viewImage(tr.portfolio_image)" style="width:80px" alt="portfolio_image" />
            </vs-td>
            <vs-td>{{ tr.position  }}</vs-td>
            <vs-td>{{ tr.created_at | formatDate }}</vs-td>
            <vs-td>
              <div class="uk-grid-divider uk-grid-small" style="width:152px" uk-grid>
                <div>
                  <vs-button @click="btnConfig(tr, 1)" circle icon floating success>
                    <i class="bx bx-pencil"></i>
                  </vs-button>
                </div>
                <div>
                  <vs-button @click="btnConfig(tr, 0)" danger circle icon floating>
                    <i class="bx bx-eraser"></i>
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
        ? "Edit Portfolio"
        : deleteBtn
        ? "Delete Portfolio"
        : "Create Portfolio"
        }}
      </div>
      <hr />

      <div class="uk-card-body uk-margin-small-top uk-width-large uk-margin-medium-top uk-padding-remove-top uk-padding-remove-bottom">
        <!-- <vs-input v-model="form.name" class="labelYes" placeholder="Portfolio Title" :readonly="deleteBtn">
          <template #message-danger>
            <has-error :form="form" field="name"></has-error>
          </template>
        </vs-input> -->

        <vs-input v-model="form.name" class="labelYes" label="Portfolio Title" :readonly="deleteBtn">
          <template #message-danger>
            <has-error :form="form" field="name"></has-error>
          </template>
        </vs-input>

        <div v-if="!category_loading" class="uk-margin-medium-top uk-width-1-1@m">
          <vs-select label="Select Category" v-model="form.category_id">
            <template #message-danger>
              <has-error :form="form" field="category_id"></has-error>
            </template>

            <vs-option v-for="(sub, index) in allCategory" :key="index + 'Category'" :label="sub.category_name" :value="sub.id">{{ sub.category_name }}</vs-option>
          </vs-select>
        </div>

        <div class="uk-margin-medium-top uk-width-1-1@m">
          <vs-input v-model="form.description" class="labelYes" label="Description" :readonly="deleteBtn">
            <template #message-danger>
              <has-error :form="form" field="description"></has-error>
            </template>
          </vs-input>
        </div>

        <div class="uk-margin-medium-top uk-width-1-1@m">
          <vs-input v-model="form.link" class="labelYes" label="Project Link" :readonly="deleteBtn">
            <template #message-danger>
              <has-error :form="form" field="link"></has-error>
            </template>
          </vs-input>
        </div>

        <div class="uk-margin-medium-top uk-width-1-1@m">
          <vs-input type="number" v-model="form.position" class="labelYes" label="Position" :readonly="deleteBtn">
            <template #message-danger>
              <has-error :form="form" field="position"></has-error>
            </template>
          </vs-input>
        </div>

        <div class="uk-margin" v-if="!deleteBtn">
          <span class="uk-text-middle">Select Image</span>
          <div uk-form-custom>
            <input type="file" @change="imageSubmit" accept="image/x-png, image/jpeg" />
            <span class="uk-link">upload</span>
          </div>
          <div class="uk-text-small uk-text-danger">
            <has-error :form="form" field="portfolio_image"></has-error>
          </div>

          <img style="margin-top:6px" :src="form.portfolio_image" alt v-if="form.portfolio_image !== '' && !editBtn" />
        </div>

        <div class="uk-margin uk-margin-medium-top" v-if="editBtn">
          <div class="uk-text-small uk-margin-small-bottom" style="font-size:16px !important;">{{ form.update_image ? 'New Image:' : 'Old Image:'}}</div>
          <img :src="form.portfolio_image" alt v-if="editBtn" />
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

    <!-- #### View Image #### -->
    <vs-dialog not-close auto-width not-padding v-model="active_large_image_modal">
      <div class="con-image">
        <img v-if="large_image !== ''" :src="large_image" alt="large_image" />
      </div>
    </vs-dialog>
    <!-- #### View Image #### -->
  </div>
</template>
<script>
export default {
  data: () => ({
    form: new Form({
      id: '',
      name: '',
      portfolio_image: '',
      link: '',
      description: '',
      category_id: '',
      position: '',
      update_image: false
    }),
    search: '',
    allCategory: [],
    category_loading: true,

    page: 1,
    max: 6,
    submitBtn: false,
    editBtn: false,
    deleteBtn: false,
    activeModel: false,
    allData: null,
    large_image: '',
    active_large_image_modal: false,
    loading_data: true
  }),
  methods: {
    getData() {
      axios
        .get('/data/protfolio')
        .then(res => {
          this.allData = res.data;
          this.loading_data = false;
        })
        .catch(err => {
          this.openNotification();
        });
    },
    submitForm() {
      this.form
        .post('/data/protfolio')
        .then(res => {
          this.form.reset();
          this.activeModel = false;
          this.getData();
        })
        .catch(err => {
          this.openNotification();
        });
    },
    editData() {
      this.form
        .put(`/data/protfolio/${this.form.id}`)
        .then(res => {
          this.form.reset();
          this.activeModel = false;
          this.getData();
        })
        .catch(err => {
          this.openNotification();
        });
    },
    deleteData() {
      this.form
        .delete(`/data/protfolio/${this.form.id}`)
        .then(res => {
          this.form.reset();
          this.activeModel = false;
          this.getData();
        })
        .catch(err => {
          this.openNotification();
        });
    },
    imageSubmit(e) {
      this.form.update_image = false;
      if (e.target.files[0] !== null) {
        const file = e.target.files[0];
        this.form.update_image = true;
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onloadend = () => {
          this.form.portfolio_image = reader.result;
        };
      }
    },
    viewImage(value) {
      this.large_image = value;
      this.active_large_image_modal = true;
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
        progress: 'auto',
        position: 'bottom-left',
        // sticky: true,
        title: "<i class='bx bxs-bug' ></i> There Is Some Error.",
        text: `Check Your Input Fields Or Your Internet Connection And Try Again.`
      });
    },
    getCategory() {
      axios
        .get('/data/category')
        .then(res => {
          this.allCategory = res.data;
          this.category_loading = false;
        })
        .catch(err => {
          this.openNotification();
        });
    }
  },
  created() {
    this.getCategory();
    this.getData();
  }
};
</script>


