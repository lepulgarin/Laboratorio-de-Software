<template>
  <form action>
    <div class="form-group row">
      <div class="col-sm-12">
        <div class="form-group row">
          <label class="col-sm-5 col-form-label">Dia Requerido:</label>
          <div class="col-sm-4">
            <select class="form-control" v-model="MDia">
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
              v-model="MHorarioD"
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
              v-model="MHorarioH"
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
  props: ["id"],
  mounted() {},
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
      MHorarioD: "",
      MHorarioH: "",
      MDia: "",
      idF: "",
    };
  },
  methods: {
    newSchedule() {
      if (this.MHorarioD == "" || this.MHorarioH == "" || this.MDia == "") {
        alert("Ingrese un Horario Válido");
      } else {
        let sche = {
          MDia: this.MDia,
          MHorarioD: new Date(this.MHorarioD),
          MHorarioH: new Date(this.MHorarioH),
          idF: this.idF
        };
        if (sche.MHorarioD.getHours() > sche.MHorarioH.getHours()) {
          alert("Hora de Inicio Debe Ser Menor a Hora de Fin");
        } else if (sche.MHorarioD.getHours() == sche.MHorarioH.getHours()) {
          if (sche.MHorarioD.getMinutes() > sche.MHorarioH.getMinutes()) {
            alert("Hora de Inicio Debe Ser Menor a Hora de Fin");
          } else {
            this.$emit("schedule", sche);
            this.MDia = "";
            this.MHorarioD = "";
            this.MHorarioH = "";
          }
        } else {
          this.$emit("schedule", sche);
          this.MDia = "";
          this.MHorarioD = "";
          this.MHorarioH = "";
        }
      }
    }
  }
};
</script>