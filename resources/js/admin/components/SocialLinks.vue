<template>
  <div class>
    <div class="uk-flex-middle uk-margin-medium-bottom" uk-grid>
      <div class="uk-width-1-2">
        <div class="uk-flex uk-flex-right">
          <!-- <vs-button style="width: 108px" @click="addNew">
            Add New
            <template #animate>
              <i class="bx bx-plus" style="font-size:22px"></i>
            </template>
          </vs-button> -->
        </div>
      </div>
      <div class="uk-width-1-2 uk-flex-first">
        <div>
          <h4 class="uk-h4 uk-margin-remove">Social Link Table</h4>
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
            <vs-th>Facebook</vs-th>
            <vs-th>Whatsapp</vs-th>
            <vs-th>youtube</vs-th>
            <!-- <vs-th>Created At</vs-th> -->
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
            <vs-td>{{ tr.facebook ? tr.facebook : '---' }}</vs-td>
            <vs-td>{{ tr.whatsapp ? tr.whatsapp : '---' }}</vs-td>
            <vs-td>{{ tr.youtube ? tr.youtube : '---' }}</vs-td>
            <!-- <vs-td>{{ tr.created_at | formatDate }}</vs-td> -->
            <vs-td>
              <div class="uk-grid-divider uk-grid-small" style="width:152px" uk-grid>
                <div>
                  <vs-button @click="btnConfig(tr, 1)" circle icon floating success>
                    <i class="bx bx-pencil"></i>
                  </vs-button>
                </div>
                <!-- <div>
                  <vs-button @click="btnConfig(tr, 0)" danger circle icon floating>
                    <i class="bx bx-eraser"></i>
                  </vs-button>
                </div> -->
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

    <vs-dialog overflow-hidden not-center prevent-close v-model="activeModel">
      <div class="uk-card-title uk-margin-small-top uk-card-body uk-padding-remove-top uk-padding-remove-bottom uk-padding-remove-right">
        {{
        editBtn
        ? "Edit Social Link"
        : deleteBtn
        ? "Delete Social Link"
        : "Create Social Link"
        }}
      </div>
      <hr />

      <div class="uk-card-body uk-margin-small-top uk-width-2xlarge uk-margin-medium-top uk-padding-remove-top uk-padding-remove-bottom">
        <div class=" uk-grid-small" uk-grid>
          <div class="uk-width-1-2">
            <vs-input v-model="form.facebook" class="labelYes" label="Facebook Link" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="facebook"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-width-1-2">
            <vs-input v-model="form.youtube" class="labelYes" label="Youtube Link" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="youtube"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-margin-medium-top uk-width-1-2">
            <vs-input v-model="form.instagram" class="labelYes" label="Instagram Link" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="instagram"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-margin-medium-top uk-width-1-2">
            <vs-input v-model="form.whatsapp" class="labelYes" label="Whatsapp Number" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="whatsapp"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-margin-medium-top uk-width-1-2">
            <vs-input v-model="form.phone" class="labelYes" label="Phone Number" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="phone"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-margin-medium-top uk-width-1-2">
            <vs-input v-model="form.email" class="labelYes" label="Email" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="email"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-margin-medium-top uk-width-1-2">
            <vs-input v-model="form.address" class="labelYes" label="Address" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="address"></has-error>
              </template>
            </vs-input>
          </div>

          <div class="uk-margin-medium-top uk-width-1-2">
            <vs-input v-model="form.address_link" class="labelYes" label="Address Link" :readonly="deleteBtn">
              <template #message-danger>
                <has-error :form="form" field="address_link"></has-error>
              </template>
            </vs-input>
          </div>

          <!-- profile_image: '',
        description: '',
        name: '',
        age: '',
        job: '',
        citizenship: '',
        residence: '',
        email: '' -->

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top">About Me</h4>
            <div class="uk-child-width-1-2" uk-grid>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.profile_image" class="labelYes" label="Profile Image Url" :readonly="deleteBtn">
                </vs-input>
              </div>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.cv_link" class="labelYes" label="CV Link" :readonly="deleteBtn">
                </vs-input>
              </div>

              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.name" class="labelYes" label="Name" :readonly="deleteBtn">
                </vs-input>
              </div>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.age" class="labelYes" label="Age" :readonly="deleteBtn">
                </vs-input>
              </div>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.job" class="labelYes" label="Job" :readonly="deleteBtn">
                </vs-input>
              </div>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.citizenship" class="labelYes" label="Citizenship" :readonly="deleteBtn">
                </vs-input>
              </div>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.residence" class="labelYes" label="Residence" :readonly="deleteBtn">
                </vs-input>
              </div>
              <div class="uk-margin-medium-top">
                <vs-input v-model="form.about_me.email" class="labelYes" label="Email" :readonly="deleteBtn">
                </vs-input>
              </div>
            </div>
            <div class="uk-margin-medium-top">
              <vs-input v-model="form.about_me.description" class="labelYes" label="Description" :readonly="deleteBtn">
              </vs-input>
            </div>
          </div>

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top uk-flex uk-flex-between uk-flex-middle">

              <h4 class="uk-margin-remove">
                Experience
              </h4>
              <div>
                <vs-button size="small" @click="addArr('experience')">Add</vs-button>
              </div>

            </h4>
            <div v-for="(experience,index) in form.experience" :key="index">
              <div v-if="form.experience.length > 1" style="text-align: right; top: 16px; z-index: 1; position: relative;">
                <span class="uk-text-danger" style="cursor: pointer;" @click="removeArr(index, 'experience')">Remove</span>
              </div>
              <div uk-grid>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="experience.year" class="labelYes" label="Year" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`experience.${index}.year`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="experience.title" class="labelYes" label="Title" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`experience.${index}.title`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-1">
                  <vs-input v-model="experience.description" class="labelYes" label="Description" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`experience.${index}.description`"></has-error>
                    </template>
                  </vs-input>
                </div>
              </div>
            </div>
          </div>

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top uk-flex uk-flex-between uk-flex-middle">
              <h4 class="uk-margin-remove">
                Education
              </h4>
              <div>
                <vs-button size="small" @click="addArr('education')">Add</vs-button>
              </div>
            </h4>
            <div v-for="(education,index) in form.education" :key="index">
              <div v-if="form.education.length > 1" style="text-align: right; top: 16px; z-index: 1; position: relative;">
                <span class="uk-text-danger" style="cursor: pointer;" @click="removeArr(index, 'education')">Remove</span>
              </div>
              <div uk-grid>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="education.year" class="labelYes" label="Year" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`education.${index}.year`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="education.title" class="labelYes" label="Title" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`education.${index}.title`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-1">
                  <vs-input v-model="education.description" class="labelYes" label="Description" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`education.${index}.description`"></has-error>
                    </template>
                  </vs-input>
                </div>
              </div>
            </div>
          </div>

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top uk-flex uk-flex-between uk-flex-middle">
              <h4 class="uk-margin-remove">
                Languages Skills
              </h4>
              <div>
                <vs-button size="small" @click="addArr('languages_skills')">Add</vs-button>
              </div>
            </h4>
            <div v-for="(languages_skills,index) in form.languages_skills" :key="index">
              <div v-if="form.languages_skills.length > 1" style="text-align: right; top: 16px; z-index: 1; position: relative;">
                <span class="uk-text-danger" style="cursor: pointer;" @click="removeArr(index, 'languages_skills')">Remove</span>
              </div>
              <div uk-grid>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="languages_skills.name" class="labelYes" label="Name" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`languages_skills.${index}.name`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="languages_skills.percentage" class="labelYes" label="Percentage" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`languages_skills.${index}.percentage`"></has-error>
                    </template>
                  </vs-input>
                </div>
              </div>
            </div>
          </div>

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top uk-flex uk-flex-between uk-flex-middle">
              <h4 class="uk-margin-remove">
                Coding Skills
              </h4>
              <div>
                <vs-button size="small" @click="addArr('coding_skills')">Add</vs-button>
              </div>
            </h4>
            <div v-for="(coding_skills,index) in form.coding_skills" :key="index">
              <div v-if="form.coding_skills.length > 1" style="text-align: right; top: 16px; z-index: 1; position: relative;">
                <span class="uk-text-danger" style="cursor: pointer;" @click="removeArr(index, 'coding_skills')">Remove</span>
              </div>
              <div uk-grid>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="coding_skills.name" class="labelYes" label="Name" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`coding_skills.${index}.name`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="coding_skills.percentage" class="labelYes" label="Percentage" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`coding_skills.${index}.percentage`"></has-error>
                    </template>
                  </vs-input>
                </div>
              </div>
            </div>
          </div>

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top uk-flex uk-flex-between uk-flex-middle">
              <h4 class="uk-margin-remove">
                Knowledge
              </h4>
              <div>
                <vs-button size="small" @click="addArr('knowledge')">Add</vs-button>
              </div>
            </h4>
            <div v-for="(knowledge,index) in form.knowledge" :key="index">
              <div v-if="form.knowledge.length > 1" style="text-align: right; top: 16px; z-index: 1; position: relative;">
                <span class="uk-text-danger" style="cursor: pointer;" @click="removeArr(index, 'knowledge')">Remove</span>
              </div>
              <div uk-grid>
                <div class="uk-margin-medium-top uk-width-1-1">
                  <vs-input v-model="knowledge.title" class="labelYes" label="Title" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`knowledge.${index}.title`"></has-error>
                    </template>
                  </vs-input>
                </div>
              </div>
            </div>
          </div>

          <div class="uk-width-1-1">
            <hr>
            <h4 class="uk-margin-remove-bottom uk-margin-small-top uk-flex uk-flex-between uk-flex-middle">
              <h4 class="uk-margin-remove">
                My Services
              </h4>
              <div>
                <vs-button size="small" @click="addArr('my_services')">Add</vs-button>
              </div>
            </h4>
            <div v-for="(my_services,index) in form.my_services" :key="index">
              <div v-if="form.my_services.length > 1" style="text-align: right; top: 16px; z-index: 1; position: relative;">
                <span class="uk-text-danger" style="cursor: pointer;" @click="removeArr(index, 'my_services')">Remove</span>
              </div>
              <div uk-grid>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="my_services.icon" class="labelYes" label="Icon" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`my_services.${index}.icon`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-2">
                  <vs-input v-model="my_services.title" class="labelYes" label="Title" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`my_services.${index}.title`"></has-error>
                    </template>
                  </vs-input>
                </div>
                <div class="uk-margin-medium-top uk-width-1-1">
                  <vs-input v-model="my_services.description" class="labelYes" label="Description" :readonly="deleteBtn">
                    <template #message-danger>
                      <has-error :form="form" :field="`my_services.${index}.description`"></has-error>
                    </template>
                  </vs-input>
                </div>
              </div>
            </div>
          </div>

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
      id: '',
      facebook: '',
      whatsapp: '',
      youtube: '',
      instagram: '',
      address: '',
      phone: '',
      email: '',
      address_link: '',

      //
      about_me: {
        profile_image: '',
        description: '',
        name: '',
        age: '',
        job: '',
        citizenship: '',
        residence: '',
        email: '',
        cv_link: ''
      },
      experience: [
        {
          year: '',
          title: '',
          description: ''
        }
      ],
      education: [
        {
          year: '',
          title: '',
          description: ''
        }
      ],
      my_services: [
        {
          icon: '',
          title: '',
          description: ''
        }
      ],
      languages_skills: [
        {
          name: '',
          percentage: ''
        }
      ],
      coding_skills: [
        {
          name: '',
          percentage: ''
        }
      ],
      knowledge: [
        {
          title: ''
        }
      ]
    }),

    search: '',
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
    addArr(type) {
      if (type == 'experience') {
        this.form.experience.push({ year: '', title: '', description: '' });
      }
      if (type == 'education') {
        this.form.education.push({ year: '', title: '', description: '' });
      }
      if (type == 'languages_skills') {
        this.form.languages_skills.push({ name: '', percentage: '' });
      }
      if (type == 'coding_skills') {
        this.form.coding_skills.push({ name: '', percentage: '' });
      }
      if (type == 'knowledge') {
        this.form.knowledge.push({ title: '' });
      }
      if (type == 'my_services') {
        this.form.my_services.push({ icon: '', title: '', description: '' });
      }
    },
    removeArr(index, type) {
      if (type == 'experience') {
        this.form.experience.splice(index, 1);
      }
      if (type == 'education') {
        this.form.education.splice(index, 1);
      }

      if (type == 'languages_skills') {
        this.form.languages_skills.splice(index, 1);
      }
      if (type == 'coding_skills') {
        this.form.coding_skills.splice(index, 1);
      }
      if (type == 'knowledge') {
        this.form.knowledge.splice(index, 1);
      }
      if (type == 'my_services') {
        this.form.my_services.splice(index, 1);
      }
    },
    getData() {
      axios
        .get('/data/social-link')
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
        .post('/data/newsletter')
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
        .put(`/data/social-link/${this.form.id}`)
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
        .delete(`/data/newsletter/${this.form.id}`)
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

      this.form.about_me = tr.about_me
        ? JSON.parse(tr.about_me)
        : {
            profile_image: '',
            description: '',
            name: '',
            age: '',
            job: '',
            citizenship: '',
            residence: '',
            email: '',
            cv_link: ''
          };

      this.form.experience = tr.experience
        ? JSON.parse(tr.experience)
        : [
            {
              year: '',
              title: '',
              description: ''
            }
          ];

      this.form.education = tr.education
        ? JSON.parse(tr.education)
        : [
            {
              year: '',
              title: '',
              description: ''
            }
          ];

      this.form.languages_skills = tr.languages_skills
        ? JSON.parse(tr.languages_skills)
        : [
            {
              name: '',
              percentage: ''
            }
          ];

      this.form.coding_skills = tr.coding_skills
        ? JSON.parse(tr.coding_skills)
        : [
            {
              name: '',
              percentage: ''
            }
          ];

      this.form.knowledge = tr.knowledge
        ? JSON.parse(tr.knowledge)
        : [
            {
              title: ''
            }
          ];

      this.form.my_services = tr.my_services
        ? JSON.parse(tr.my_services)
        : [
            {
              icon: '',
              title: '',
              description: ''
            }
          ];

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


