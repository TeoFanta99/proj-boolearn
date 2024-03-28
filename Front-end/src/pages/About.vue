<script>
export default {
  name: "About",
};
</script>

<template>
  <main>
    <div class="container">
      <h1>ABOUT US</h1>
      <span>Il team di BooLearn crede che esista un piccolo sviluppatore dentro
        ognuno di noi. Prendendosene cura e facendolo crescere giorno dopo
        giorno, vi regalerà delle grandi soddisfazioni.
      </span>
    </div>

    <!-- <input
      type="email"
      name="txtEmail"
      class="form-control"
      placeholder="COGNOME *"
      value=""
    /> -->
  </main>
</template>

<style scoped lang="scss">

  main{

    min-height: calc(100vh - 150px);
  }
  .container {
    border: 1px solid black;
    margin-top: 50px;
    padding-top: 50px;
    padding-bottom: 50px;
    margin-bottom: 100px;
  }

</style>
