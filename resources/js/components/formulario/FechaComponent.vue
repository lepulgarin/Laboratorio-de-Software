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
  mounted() {
    console.log("Component mounted.");
  },
  components: {
    DatePicker
  },
  data() {
    return {
      date: ''
    };
  },
  methods: {
    newDate() {
      this.$emit('new',this.date);
    }
  }
};
</script>