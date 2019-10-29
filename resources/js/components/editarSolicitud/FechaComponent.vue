<template>
  <div>
    <date-picker
      v-model="date"
      lang="es"
      type="date"
      format="YYYY-MM-DD"
      placeholder="Fecha"
      width="148"
      @input="newDate()"
    ></date-picker>
  </div>
</template>

<script>
import DatePicker from "vue2-datepicker";
export default {
  props: ["fecha"],
  mounted() {
    var fechaT = this.fecha.split("-");
    fechaT = new Date(fechaT[0], fechaT[1] - 1, fechaT[2]);
    this.date = fechaT;
    this.$emit("new", this.date);
  },
  components: {
    DatePicker
  },
  data() {
    return {
      date: ""
    };
  },
  methods: {
    newDate() {
      this.$emit("new", this.date);
    }
  }
};
</script>