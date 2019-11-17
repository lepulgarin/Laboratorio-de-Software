<template>
  <form action>
    <div class="form-group row">
      <div class="col-sm-12">
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">Dia Requerido:</label>
          <div class="col-sm-4">
            <select class="form-control" v-model="day">
              <option>Lunes</option>
              <option>Martes</option>
              <option>Miércoles</option>
              <option>Jueves</option>
              <option>Viernes</option>
              <option>Sábado</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">Horario Requerido:</label>
          <label class="col-sm-3 col-form-label">Desde:</label>
          <div class="col-sm-4">
            <date-picker
              v-model="timeIni"
              lang="en"
              type="time"
              format="hh:mm a"
              placeholder="Hora"
              :time-picker-options="timePickerOption"
              width="100"
            ></date-picker>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-5 col-form-label"></label>
          <label class="col-sm-3 col-form-label">Hasta:</label>
          <div class="col-sm-2">
            <date-picker
              v-model="timeEnd"
              lang="en"
              type="time"
              format="hh:mm a"
              placeholder="Hora"
              :time-picker-options="timePickerOption"
              width="100"
            ></date-picker>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-5 col-form-label"></label>
          <form action v-on:submit.prevent="newSchedule()" class="col-sm-5">
            <button type="submit" class="btn btn-primary">Agregar horario</button>
          </form>
        </div>
      </div>
    </div>
  </form>
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
      timePickerOption: {
        start: "07:00",
        step: "00:30",
        end: "22:00"
      },
      timeIni: "",
      timeEnd: "",
      day: ""
    };
  },
  methods: {
    newSchedule() {
      if (this.timeIni == "" || this.timeEnd == "" || this.day == "") {
        alert("Ingrese un Horario Válido");
      } else {
        let sche = {
          day: this.day,
          timeIni: new Date(this.timeIni),
          timeEnd: new Date(this.timeEnd)
        };
        if (sche.timeIni.getHours() > sche.timeEnd.getHours()) {
          alert("Hora de Inicio Debe Ser Menor a Hora de Fin");
        } else if (sche.timeIni.getHours() == sche.timeEnd.getHours()) {
          if (sche.timeIni.getMinutes() > sche.timeEnd.getMinutes()) {
            alert("Hora de Inicio Debe Ser Menor a Hora de Fin");
          } else {
            this.$emit("schedule", sche);
            this.day = "";
            this.timeIni = "";
            this.timeEnd = "";
          }
        } else {
          this.$emit("schedule", sche);
          this.day = "";
          this.timeIni = "";
          this.timeEnd = "";
        }
      }
    }
  }
};
</script>