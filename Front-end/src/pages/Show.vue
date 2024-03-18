<script>
import axios from "axios";

export default {
  name: "Show",

  props: {
    infoTeach: Object,
  },
  mounted() {
    console.log(this.infoTeach.id);
  },
};
</script>

<template></template>
<style>
.img_circle {
  width: 60%;
}
</style>
