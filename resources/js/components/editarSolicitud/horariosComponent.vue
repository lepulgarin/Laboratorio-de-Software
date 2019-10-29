<template>
  <form action>
    <div class="form-group" style="margin-bottom:-28px; ">
      <div class="form-group row">
        <div class="col-sm-1">
          <label>
            <b>Dia</b>
          </label>
        </div>
        <div class="col-sm-2">
          <label for>{{horario.MDia}}</label>
        </div>
        <div class="col-sm-1">
          <label for>
            <b>Hora inicio</b>
          </label>
        </div>
        <div class="col-sm-2">
          <label
            for
          >{{ horario.MHorarioD.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })}}</label>
        </div>
        <div class="col-sm-1">
          <label for>
            <b>Hora fin</b>
          </label>
        </div>
        <div class="col-sm-2">
          <label
            for
          >{{horario.MHorarioH.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true })}}</label>
        </div>
        <div class="col-sm-3">
          <button type="button" class="btn btn-danger col-12" v-on:click="onClickDelete()">Eliminar</button>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
import DatePicker from "vue2-datepicker";
export default {
  props: ["horario"],
  mounted() {
  },
  data() {
    return {};
  },
  methods: {
    onClickDelete() {
      this.$emit("delete");
    }
  }
};
</script>