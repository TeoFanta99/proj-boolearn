<script>
//importo store
import { store } from "../store";

export default {
  name: "FAQ",

  data() {
    return {
      store,
    };
  },
};
</script>

<template>
  <div class="background">
    <div class="container">
      <div class="row">
        <!-- Sezione Accordion di sinistra -->
        <div class="col-sm-12 col-md-12 col-lg-6">
          <ul class="accordion">
            <li>
              <input type="checkbox" name="accordian" id="first" />
              <label for="first">High Rate of Success</label>
              <div class="content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  ultrices auctor sapien id cursus. Aliquam maximus turpis in
                  vehicula semper.
                </p>
              </div>
            </li>

            <li>
              <input type="checkbox" name="accordian" id="second" />
              <label for="second">Zero Accident Rate</label>
              <div class="content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  ultrices auctor sapien id cursus. Aliquam maximus turpis in
                  vehicula semper.
                </p>
              </div>
            </li>

            <li>
              <input type="checkbox" name="accordian" id="third" />
              <label for="third">We're Never Late</label>
              <div class="content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  ultrices auctor sapien id cursus. Aliquam maximus turpis in
                  vehicula semper.
                </p>
              </div>
            </li>
          </ul>
        </div>
        <!-- Sezione Accordion di destra -->
        <div class="col-sm-12 col-md-12 col-lg-6">
          <ul class="accordion">
            <li>
              <input type="checkbox" name="accordian" id="fourth" />
              <label for="fourth">Price Promise</label>
              <div class="content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  ultrices auctor sapien id cursus. Aliquam maximus turpis in
                  vehicula semper.
                </p>
              </div>
            </li>

            <li>
              <input type="checkbox" name="accordian" id="fifth" />
              <label for="fifth">True Professionals</label>
              <div class="content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  ultrices auctor sapien id cursus. Aliquam maximus turpis in
                  vehicula semper.
                </p>
              </div>
            </li>

            <li>
              <input type="checkbox" name="accordian" id="sixth" />
              <label for="sixth">We Work Around You</label>
              <div class="content">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                  ultrices auctor sapien id cursus. Aliquam maximus turpis in
                  vehicula semper.
                </p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
//Scss relativo alla sola sezione di header
@use "../styles/partials/variables" as *;

.background {
  background-color: rgb(113, 169, 253);
  .row {
    // Styles Accordion
    .accordion {
      width: 100%;

      li {
        list-style: none;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 2px solid gray;
        background: #ffff;
        box-shadow: 6px 6px 10px -1px rgba(0, 0, 0, 0.15),
          -6px -6px 10px -1px rgba(255, 255, 255, 0.7);

        input[type="checkbox"] {
          display: none;
        }

        input[type="checkbox"]:checked + label + .content {
          max-height: 400px;
          padding: 10px 10px 20px;
        }

        input[type="checkbox"]:checked + label::before {
          content: "-";
        }

        label {
          display: flex;
          align-items: center;
          color: #7abc64;
          font-size: 18px;
          font-weight: 600;
          cursor: pointer;
        }

        label::before {
          content: "+";
          margin-right: 15px;
          font-size: 24px;
          font-weight: 700;
          color: gray;
        }

        .content {
          color: #7099a5;
          padding: 0 10px;
          line-height: 26px;
          max-height: 0;
          overflow: hidden;
          transition: max-height 0.4s, padding 0.4s;
        }
      }
    }
  }
}
</style>
