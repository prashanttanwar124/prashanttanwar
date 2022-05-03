<template>
  <div class="wrapper">

    <!-- Started -->
    <div class="section started">
      <div class="centrize full-width">
        <div class="vertical-center">
          <div class="started-content">
            <div class="h-title glitch-effect" data-text="Portfolio">Portfolio</div>
            <div class="h-subtitle typing-bread">
              <p>
                <router-link to="/">Home</router-link> /
                <router-link to="/portfolio">Portfolio</router-link>
              </p>
            </div>
            <span class="typed-bread"></span>
          </div>
        </div>
      </div>
      <a href="#" class="mouse_btn"><span class="ion ion-mouse"></span></a>
    </div>

    <!-- Works -->
    <div class="section works">
      <div class="content">

        <div class="filter-menu">
          <div class="filters">
            <div class="btn-group">
              <label data-text="All" class="glitch-effect">
                <input type="radio" name="fl_radio" value=".box-item" />All
              </label>
            </div>
            <div class="btn-group" v-for="(category,index) in allCategory" :key="index">
              <label data-text="Video">
                <input type="radio" name="fl_radio" :value="'.f-'+category.slug" />{{ category.category_name }}
              </label>
            </div>
            <!-- <div class="btn-group">
              <label data-text="Music">
                <input type="radio" name="fl_radio" value=".f-music" />Music
              </label>
            </div>
            <div class="btn-group">
              <label data-text="Links">
                <input type="radio" name="fl_radio" value=".f-links" />Links
              </label>
            </div>
            <div class="btn-group">
              <label data-text="Image">
                <input type="radio" name="fl_radio" value=".f-image" />Image
              </label>
            </div>
            <div class="btn-group">
              <label data-text="Gallery">
                <input type="radio" name="fl_radio" value=".f-gallery" />Gallery
              </label>
            </div>
            <div class="btn-group">
              <label data-text="Content">
                <input type="radio" name="fl_radio" value=".f-content" />Content
              </label>
            </div> -->
          </div>
        </div>

        <div class="box-items portfolio-items">

          <!-- <div class="box-item f-video">
            <div class="image">
              <a href="https://youtu.be/S4L8T2kFFck" class="has-popup-video">
                <img src="images/works/work2.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-videocamera"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">Video</div>
              <a href="https://youtu.be/S4L8T2kFFck" class="name has-popup-video">Coffee Cup In Hand</a>
            </div>
          </div>

          <div class="box-item f-links">
            <div class="image">
              <a href="https://beshley.com/" class="has-popup-link" target="_blank">
                <img src="images/works/work8.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-link"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">Links</div>
              <a href="https://beshley.com/" class="name has-popup-link">Love & Care Ceramic Bottles</a>
            </div>
          </div>

          <div class="box-item f-image">
            <div class="image">
              <a href="images/works/work4.jpg" class="has-popup-image">
                <img src="images/works/work4.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-image"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">Image</div>
              <a href="images/works/work4.jpg" class="name has-popup-image">Shopping gift bag</a>
            </div>
          </div>

          <div class="box-item f-gallery">
            <div class="image">
              <a href="#gallery-2" class="has-popup-gallery">
                <img src="images/works/work5.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-images"></span>
                    </span>
                  </span>
                </span>
              </a>
              <div id="gallery-2" class="mfp-hide">
                <a href="images/works/work5.jpg"></a>
                <a href="images/works/work2.jpg"></a>
                <a href="images/works/work3.jpg"></a>
                <a href="images/works/work4.jpg"></a>
              </div>
            </div>
            <div class="desc">
              <div class="category">Gallery</div>
              <a href="#gallery-2" class="name has-popup-gallery">Amore Mio Three Cups</a>
            </div>
          </div>

          <div class="box-item f-music">
            <div class="image">
              <a href="https://w.soundcloud.com/player/?visual=true&#038;url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F221650664&#038;show_artwork=true" class="has-popup-music">
                <img src="images/works/work6.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-music-note"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">Music</div>
              <a href="https://w.soundcloud.com/player/?visual=true&#038;url=http%3A%2F%2Fapi.soundcloud.com%2Ftracks%2F221650664&#038;show_artwork=true" class="name has-popup-music">Marta Veludo Beautiful Poster</a>
            </div>
          </div>

          <div class="box-item f-image">
            <div class="image">
              <a href="images/works/work7.jpg" class="has-popup-image">
                <img src="images/works/work7.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-image"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">Image</div>
              <a href="images/works/work7.jpg" class="name has-popup-image">Minimal Poster Frame</a>
            </div>
          </div> -->

          <div :class="'box-item f-'+portfolio.category.slug" v-for="(portfolio,index) in allPortfolio" :key="index">
            <div class="image">
              <a :href="'#popup-'+index" class="has-popup-media">
                <img :src="portfolio.portfolio_image" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-ios-plus-empty"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">{{ portfolio.category.category_name }}</div>
              <a :href="'#popup-'+index" class="name has-popup-media">{{ portfolio.name }}</a>
            </div>
            <div :id="'popup-'+index" class="popup-box mfp-fade mfp-hide">
              <div class="content">
                <div class="image">
                  <img :src="portfolio.portfolio_image" alt="">
                </div>
                <div class="desc">
                  <div class="category">{{ portfolio.category.category_name }}</div>
                  <h4>{{ portfolio.name }}</h4>
                  <p>
                    {{ portfolio.description }}
                  </p>
                  <a :href="portfolio.link" target="_blank" class="btn" data-text="View Project">View Project</a>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="box-item f-content">
            <div class="image">
              <a href="#popup-2" class="has-popup-media">
                <img src="images/works/work3.jpg" alt="" />
                <span class="info">
                  <span class="centrize full-width">
                    <span class="vertical-center">
                      <span class="ion ion-ios-plus-empty"></span>
                    </span>
                  </span>
                </span>
              </a>
            </div>
            <div class="desc">
              <div class="category">Content</div>
              <a href="#popup-2" class="name has-popup-media">Cardboard Box</a>
            </div>
            <div id="popup-2" class="popup-box mfp-fade mfp-hide">
              <div class="content">
                <div class="image">
                  <img src="images/works/work9.jpg" alt="">
                </div>
                <div class="desc">
                  <div class="category">Graphics</div>
                  <h4>Hello World Paper</h4>
                  <p>
                    Consul latine iudicabit eu vel. Cu has animal eruditi voluptatibus. Eu volumus explicari sed. Mel mutat vituperata
                    suscipiantur et, et fabellas explicari adipiscing quo, no mucius euismod vis. Cu vim quem quod cibo.
                  </p>
                  <a href="#" class="btn" data-text="View Project">View Project</a>
                </div>
              </div>
            </div>
          </div> -->
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
      allCategory: [],
      allPortfolio: []
    };
  },
  methods: {
    getData() {
      axios
        .get('/website-data/portfolio')
        .then(res => {
          var data = res.data;
          this.allPortfolio = data.allPortfolio;
          this.allCategory = data.allCategory;
        })
        .finally(() => {
          this.loadScript();
          this.mainLoader();
        });
    },
    loadScript() {
      //   this.titleLinkHeight();
      var $container = $('.section.works .box-items');
      $container.imagesLoaded(function() {
        $container.isotope({
          itemSelector: '.box-item'
        });
      });

      $('.has-popup-media').magnificPopup({
        type: 'inline',
        overflowY: 'auto',
        closeBtnInside: true,
        mainClass: 'mfp-fade'
      });

      $('.filters').on('click', '.btn-group', function() {
        var filterValue = $(this)
          .find('input')
          .val();
        $container.isotope({ filter: filterValue });
        $('.filters .btn-group label').removeClass('glitch-effect');
        $(this)
          .find('label')
          .addClass('glitch-effect');
      });
    }
  },
  created() {
    this.getData();
  }
};
</script>
