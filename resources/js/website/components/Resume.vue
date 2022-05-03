<template>
  <div class="wrapper">

    <!-- Started -->
    <div class="section started">
      <div class="centrize full-width">
        <div class="vertical-center">
          <div class="started-content">
            <div class="h-title glitch-effect" data-text="Resume">Resume</div>
            <div class="h-subtitle typing-bread">
              <p>
                <router-link to="/">Home</router-link> /
                <router-link to="/resume">Resume</router-link>
              </p>
            </div>
            <span class="typed-bread"></span>
          </div>
        </div>
      </div>
      <a href="#" class="mouse_btn"><span class="ion ion-mouse"></span></a>
    </div>

    <!-- About -->
    <div v-if="info">
      <div class="section about">
        <div class="content">
          <div class="title">
            <div class="title_inner">About Me</div>
          </div>
          <div class="image">
            <div class="mainHeroIMG" v-if="jsonParse(info.about_me).profile_image" :style="`background-image: url('${jsonParse(info.about_me).profile_image}')`" />
            <img v-else src="images/man1.jpg" alt="" />
          </div>
          <div class="desc">
            <p>
              {{ jsonParse(info.about_me).description }}
            </p>
            <div class="info-list">
              <ul>
                <li><strong>Name:</strong> {{ jsonParse(info.about_me).name }}</li>
                <li><strong>Age:</strong> {{ jsonParse(info.about_me).age }}</li>
                <li><strong>Job:</strong> {{ jsonParse(info.about_me).job }}</li>
                <li><strong>Citizenship:</strong> {{ jsonParse(info.about_me).citizenship }}</li>
                <li><strong>Residence: </strong> {{ jsonParse(info.about_me).residence }}</li>
                <li><strong>E-mail:</strong> {{ jsonParse(info.about_me).email }}</li>
              </ul>
            </div>
            <div class="bts"><a :href="jsonParse(info.about_me).cv_link" target="_blank" class="btn fill" data-text="Download CV">Download CV</a></div>
          </div>
          <div class="clear"></div>
        </div>
      </div>

      <!-- Resume -->
      <div class="section resume">
        <div class="content">
          <div class="cols">
            <div class="col col-md">
              <div class="title">
                <div class="title_inner">Experience</div>
              </div>
              <div class="resume-items">
                <div class="resume-item active" v-for="(experience,index) in jsonParse(info.experience)" :key="index">
                  <div class="date">{{ experience.year }}</div>
                  <div class="name">{{ experience.title }}</div>
                  <p>
                    {{ experience.description }}
                  </p>
                </div>
              </div>
            </div>
            <div class="col col-md">
              <div class="title">
                <div class="title_inner">Education</div>
              </div>
              <div class="resume-items">
                <div class="resume-item" v-for="(education,index) in jsonParse(info.education)" :key="index">
                  <div class="date">{{ education.year }}</div>
                  <div class="name">{{ education.title }}</div>
                  <p>
                    {{ education.description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Skills -->
      <!-- <div class="section skills">
      <div class="content">
        <div class="title">
          <div class="title_inner">Design Skills</div>
        </div>
        <div class="skills">
          <ul>
            <li>
              <div class="name">Web Design</div>
              <div class="progress">
                <div class="percentage" style="width:70%;">
                  <span class="percent">70%</span>
                </div>
              </div>
            </li>
            <li>
              <div class="name">Illustrations</div>
              <div class="progress">
                <div class="percentage" style="width:90%;">
                  <span class="percent">90%</span>
                </div>
              </div>
            </li>
            <li>
              <div class="name">Photoshop</div>
              <div class="progress">
                <div class="percentage" style="width:75%;">
                  <span class="percent">75%</span>
                </div>
              </div>
            </li>
            <li>
              <div class="name">Graphic Design</div>
              <div class="progress">
                <div class="percentage" style="width:80%;">
                  <span class="percent">80%</span>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div> -->

      <!-- Skills -->
      <div class="section skills">
        <div class="content">
          <div class="title">
            <div class="title_inner">Languages Skills</div>
          </div>
          <div class="skills dotted">
            <ul>
              <li class="resume-item" v-for="(languages_skills,index) in jsonParse(info.languages_skills)" :key="index">
                <div class="name">{{ languages_skills.name }}</div>
                <div class="progress">
                  <div class="percentage" :style="'width: '+languages_skills.percentage">
                    <span class="percent">{{ languages_skills.percentage }}</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Skills -->
      <div class="section skills">
        <div class="content">
          <div class="title">
            <div class="title_inner">Coding Skills</div>
          </div>
          <div class="skills circles">
            <ul>
              <li class="resume-item" v-for="(coding_skills, index) in jsonParse(info.coding_skills)" :key="index">
                <div class="name">{{ coding_skills.name }}</div>
                <div :class="'progress p'+replaceSy(coding_skills.percentage)">
                  <div class="percentage" :style="'width: '+coding_skills.percentage">
                    <span class="percent">{{ coding_skills.percentage }}</span>
                  </div>
                  <span>{{ coding_skills.percentage }}</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Skills -->
      <div class="section skills">
        <div class="content">
          <div class="title">
            <div class="title_inner">Knowledge</div>
          </div>
          <div class="skills list">
            <ul>
              <li class="resume-item" v-for="(knowledge, index) in jsonParse(info.knowledge)" :key="index">
                <div class="name">{{ knowledge.title }}</div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Service -->
      <div class="section service">
        <div class="content">
          <div class="title">
            <div class="title_inner">My Services</div>
          </div>
          <div class="service-items">
            <div class="service-item" v-for="(my_services, index) in jsonParse(info.my_services)" :key="index">
              <div class="icon"><span :class="my_services.icon"></span></div>
              <div class="name">{{ my_services.title }}</div>
              <p>{{ my_services.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Clients -->
    <div class="section clients">
      <div class="content">
        <div class="title">
          <div class="title_inner">Clients</div>
        </div>
        <div class="box-items">
          <div class="box-item" v-for="(client,index) in allClient" :key="index">
            <div class="image">
              <a target="_blank" :href="client.link">
                <img :src="client.client_image" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-link"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>

  </div>
</template>
<script>
export default {
  data() {
    return {
      allClient: [],
      info: null
    };
  },
  methods: {
    replaceSy(data) {
      return data.replace('%', '');
    },
    jsonParse(data) {
      return JSON.parse(data);
    },
    getData() {
      axios
        .get('/website-data/client')
        .then(res => {
          var data = res.data;
          this.allClient = data.allClient;
          this.info = data.socialMedia;
        })
        .finally(() => {
          this.loadScript();
          this.mainLoader();
        });
    },
    loadScript() {
      var $container_clients = $('.section.clients .box-items');
      $container_clients.imagesLoaded(function() {
        $container_clients.isotope({
          itemSelector: '.box-item'
        });
      });

      function skills() {
        var skills_dotted = $('.skills.dotted .progress');
        var skills_dotted_w = skills_dotted.width();
        if (skills_dotted.length) {
          skills_dotted.append(
            '<span class="dg"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>'
          );
          skills_dotted
            .find('.percentage')
            .append(
              '<span class="da"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></span>'
            );
          skills_dotted.find('.percentage .da').css({ width: skills_dotted_w });
        }
      }
      setTimeout(skills, 1000);

      /*
		Circle Skills Line
	*/

      var skills_circles = $('.skills.circles .progress');
      if (skills_circles.length) {
        skills_circles.append(
          '<div class="slice"><div class="bar"></div><div class="fill"></div></div>'
        );
      }
    }
  },
  created() {
    this.getData();
  },
  mounted() {}
};
</script>
<style lang="scss" scoped>
.mainHeroIMG {
  height: 100px;
  width: 100px;
  border-radius: 50%;
  background-size: cover;
  background-position: center;
}
</style>
