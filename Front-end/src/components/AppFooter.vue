<script>
export default {
  name: "AppFooter",
};
</script>

<template>
  <footer class="justify-content-center d-flex">
    <div class="row mb-5">
      <div class="ms_col col-xs-12 col-sm-12 col-md-4">
        <h3 class="mb-4">Link Utili</h3>
        <ul>
          <li>
            <a class="internal-link" href="#">HOME</a>
          </li>
          <li>
            <a class="internal-link" href="#">CONTACT</a>
          </li>
          <li>
            <a class="internal-link" href="#">ABOUT US</a>
          </li>
          <li>
            <a class="internal-link" href="#">F.A.Q.</a>
          </li>
        </ul>
      </div>
      <div
        class="ms_col col-xs-12 col-sm-12 col-md-4 d-flex flex-column justify-content-center align-items-center"
      >
        <span class="footer-address">BooLearn Inc.</span>
        <span class="footer-address">61 W 47th St, New York, NY 10036</span>
        <span class="footer-address">Stati Uniti</span>
      </div>
      <div
        class="ms_col col-xs-12 col-sm-12 col-md-4 d-flex flex-column justify-content-center align-items-around"
      >
        <ul class="d-flex justify-content-around">
          <li>
            <a href="#" class="social-link">
              <img src="../assets/footer_pics/fb.png" alt="Facebook" />
            </a>
          </li>
          <li>
            <a href="#" class="social-link">
              <img src="../assets/footer_pics/insta.png" alt="Instagram" />
            </a>
          </li>
          <li>
            <a href="#" class="social-link">
              <img src="../assets/footer_pics/linkedin.png" alt="Linkedin" />
            </a>
          </li>
        </ul>
      </div>
    </div>
  </footer>
</template>

<style scoped lang="scss">
footer {
  min-height: 150px;
  color: #d8d8d8;
  background-color: #2b2d31;

  .row {
    width: 90%;

    .ms_col {
      border: 1px solid #d8d8d8;
      margin-top: 50px;

      ul {
        list-style: none;

        li {
          margin-top: 10px;

          a {
            text-decoration: none;
            color: #d8d8d8;
          }
        }

        .internal-link:hover {
          color: white;
          font-weight: bold;
        }
      }

      img {
        width: 100%;
        height: 50px;
      }

      .footer-address {
        display: block;
      }
    }
  }
}
</style>
