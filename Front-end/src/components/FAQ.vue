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
        <h2 class="p-4">F.A.Q</h2>
        <!-- Sezione Accordion di sinistra -->
        <div class="col-sm-12 col-md-12 col-lg-6 mt-3 p-4">
          <ul>
            <li>
              <input type="checkbox" name="accordian" id="first" />
              <label for="first" class="fs-6">Informativa privacy</label>
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
              <label for="second" class="fs-6">Come posso contattare il docente al di fuori della piattaforma?</label>
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
              <label for="third" class="fs-6">Politica di rimborso</label>
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
        <div class="col-sm-12 col-md-12 col-lg-6 mt-3 p-4">
          <ul>
            <li>
              <input type="checkbox" name="accordian" id="fourth" />
              <label for="fourth" class="fs-6">Come posso pagare?</label>
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
              <label for="fifth" class="fs-6">Quali sono i nostri punti di forza?</label>
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
              <label for="sixth" class="fs-6">Lavoriamo per te 24/7!</label>
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
@use "../styles/faq.scss";
@use "../styles/header.scss";
//Scss relativo alla sola sezione di header
@use "../styles/partials/variables" as *;
</style>
