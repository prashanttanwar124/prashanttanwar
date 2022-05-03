<template>
  <div class="wrapper">
    <!-- Started -->
    <div class="section started">
      <div class="centrize full-width">
        <div class="vertical-center">
          <div class="started-content">
            <div class="h-title glitch-effect" data-text="Contacts">Contacts</div>
            <div class="h-subtitle typing-bread">
              <p>
                <router-link to="/">Home</router-link> / <router-link to="/contact">Contact</router-link>
              </p>
            </div>
            <span class="typed-bread"></span>
          </div>
        </div>
      </div>
      <a href="#" class="mouse_btn"><span class="ion ion-mouse"></span></a>
    </div>

    <!-- Contacts Info -->
    <div class="section contacts">
      <div class="content">
        <div class="title">
          <div class="title_inner">Contacts</div>
        </div>
        <div class="service-items" v-if="info">
          <div class="service-item">
            <div class="icon"><span class="ion ion-android-phone-portrait"></span></div>
            <div class="name">Phone</div>
            <p>
              <a :href="'tel:'+info.phone">{{ info.phone }}</a>
            </p>
          </div>
          <div class="service-item">
            <div class="icon"><span class="ion ion-email"></span></div>
            <div class="name">Email</div>
            <p>
              <a :href="'mailto:'+info.email">{{ info.email }}</a>
            </p>
          </div>
          <div class="service-item">
            <div class="icon"><span class="ion ion-ios-location"></span></div>
            <div class="name">Address</div>
            <p>
              {{ info.address }}
            </p>
          </div>
        </div>

        <div class="tyMessage" v-if="submit">
          Thank you for your message. I will look into this and get back to you soon.
        </div>

        <div class="contact_form" v-else>
          <div class="group-val">
            <input type="text" v-model="form.name" name="name" placeholder="Name" />
            <has-error :form="form" field="name"></has-error>
          </div>
          <div class="group-val">
            <input v-model="form.phone_number" type="number" name="phone_number" placeholder="Phone Number" />
            <has-error :form="form" field="phone_number"></has-error>
          </div>
          <div class="group-val ct-gr">
            <textarea v-model="form.message" name="message" placeholder="Message"></textarea>
            <has-error :form="form" field="message"></has-error>
          </div>
          <button class="btn fill" @click="postContactData" data-text="Send Message">Send Message</button>
          <div class="alert-success">
            <p>
              Thanks, your message is sent successfully. We will contact you shortly!
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  data: () => ({
    form: new Form({
      name: '',
      phone_number: '',
      message: ''
    }),
    info: null,
    submit: false
  }),
  methods: {
    getSocialDataLink() {
      axios
        .get('/website-data/social-link')
        .then(res => {
          this.info = res.data;
        })
        .finally(() => {
          this.mainLoader();
        });
    },
    postContactData() {
      this.form
        .post('/website-data/contact-post')
        .then(res => {
          this.submit = true;
          console.log(res.data);
        })
        .catch(err => {});
    }
  },
  created() {
    this.getSocialDataLink();
  }
};
</script>
