<template>
  <div class="container">
    <div class="card">
      <div class="card-header titulo">Solicitud Sala de Cómputo Para Docentes</div>

      <div class="card-body">
        <form>
          <form v-on:submit.prevent="checkForm" novalidate="true">
            <div v-if="errors.length" style="background-color:#d9534f">
              <label style="margin-left:10px;">
                <b>Soluciona los siguientes errores:</b>
              </label>
              <ul>
                <li v-for="error in errors" :key="error.id">{{error}}</li>
              </ul>
            </div>

            <div class="form-group row">
              <div class="alert alert-info col-sm-12" role="alert">
                Para garantizar la evaluación de la solicitud
                debe enviarla con una semana de anticipación
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nombres y Apellidos:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Ingrese sus Nombres y Apellidos Completos"
                  type="text"
                  class="form-control"
                  name="FNyA"
                  v-model="FNyA"
                  autocomplete="disabled"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Programa Docente:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Programa Académico del Docente"
                  type="text"
                  class="form-control"
                  name="FProDoc"
                  v-model="FProDoc"
                  autocomplete="disabled"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Cédula:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Número de Identificación"
                  type="text"
                  class="form-control"
                  name="FCedula"
                  v-model="FCedula"
                  autocomplete="disabled"
                  @keypress="isNumber($event)"
                />
                <small>Sin guiones ni puntos.</small>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Correo UTP:</label>
              <div class="col-sm-10 input-group mb-3">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Ingrese el nombre de usuario del correo electrónico"
                  aria-describedby="basic-addon2"
                  v-model="FCorreoUTP"
                  autocomplete="disabled"
                />
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">@utp.edu.co</span>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Correo Alterno:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Ingrese un correo alterno"
                  type="text"
                  class="form-control"
                  name="FCorreoAlt"
                  v-model="FCorreoAlt"
                  autocomplete="disabled"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Código Asignatura:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Código de la Asignatura"
                  type="text"
                  class="form-control"
                  name="FCodAsignatura"
                  v-model="FCodAsignatura"
                  autocomplete="disabled"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Nombre Asignatura:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Nombre de la Asignatura"
                  type="text"
                  class="form-control"
                  name="FNomAsignatura"
                  v-model="FNomAsignatura"
                  autocomplete="disabled"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Grupo:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Número del Grupo"
                  type="text"
                  class="form-control"
                  name="FGrupo"
                  v-model="FGrupo"
                  autocomplete="disabled"
                  @keypress="isNumber($event)"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Fecha de Inicio de Solicitud:</label>
              <div class="col-sm-10">
                <fecha-component @new="setFechaI"></fecha-component>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Fecha Fin de Solicitud:</label>
              <div class="col-sm-10">
                <fecha-component @new="setFechaF"></fecha-component>
              </div>
            </div>
            <div class="form-group row">
              <horario-component class="col-sm-5" @schedule="addSchedule"></horario-component>
              <div class="card col-sm-7">
                <ul class="list-group">
                  <li
                    class="list-group-item list-group-item-info"
                    v-for="(horario, index) in horarios"
                    :key="horario.id"
                    style="margin-left:-16px; margin-right:-16px;"
                  >
                    <horarios-component class :horario="horario" @delete="deleteSche(index)"></horarios-component>
                  </li>
                </ul>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Cantidad de Estudiantes:</label>
              <div class="col-sm-10">
                <input
                  placeholder="Cantidad de Estudiantes del Curso"
                  type="text"
                  class="form-control"
                  name="FEstudiantes"
                  v-model="FEstudiantes"
                  autocomplete="disabled"
                  @keypress="isNumber($event)"
                />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Software Necesario:</label>
              <div class="col-sm-10">
                <textarea
                  placeholder="Software Necesario"
                  type="text"
                  rows="4"
                  cols="20"
                  class="form-control"
                  name="FSoftwareN"
                  v-model="FSoftwareN"
                  autocomplete="disabled"
                ></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Equipos Audiovisuales:</label>
              <div class="custom-control custom-checkbox col-sm-10">
                <input
                  type="checkbox"
                  class="custom-control-input"
                  id="defaultUnchecked"
                  v-model="FEquipoA"
                />
                <label class="custom-control-label col-sm-3" for="defaultUnchecked">Video Beam</label>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-5"></div>
              <button type="submit" class="btn btn-primary col-sm-2">Enviar</button>
              <div class="col-sm-5"></div>
            </div>
          </form>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import DisableAutocomplete from "vue-disable-autocomplete";
Vue.use(DisableAutocomplete);
export default {
  data() {
    return {
      FNyA: "",
      FProDoc: "",
      FCedula: "",
      FCorreoUTP: "",
      FCorreoAlt: "",
      FCodAsignatura: "",
      FNomAsignatura: "",
      FGrupo: "",
      FFechaISol: "",
      FFechaFSol: "",
      FEstudiantes: "",
      FSoftwareN: "",
      FEquipoA: "",
      horarios: [],
      errors: []
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods: {
    checkForm: function(e) {
      window.scrollTo(0, 0);
      this.errors = [];

      if (!this.FNyA) {
        this.errors.push("Nombres y Apellidos Requeridos.");
      }
      if (!this.FProDoc) {
        this.errors.push("Programa Docente Requerido.");
      }
      if (!this.FCedula) {
        this.errors.push("Cédula Requerido.");
      }
      if (!this.FCorreoUTP) {
        this.errors.push("Correo UTP Requerido.");
      } else if (this.FCorreoUTP.includes("@")) {
        this.errors.push("Correo UTP sin @utp.edu.co");
      }
      if (!this.FCorreoAlt) {
        this.errors.push("Correo Alterno Requerido.");
      } else if (!this.validEmail(this.FCorreoAlt)) {
        this.errors.push("Correo Alterno Válido Requerido.");
      }
      if (!this.FCodAsignatura) {
        this.errors.push("Código Asignatura Requerido.");
      }
      if (!this.FNomAsignatura) {
        this.errors.push("Nombre Asignatura Requerido.");
      }
      if (!this.FGrupo) {
        this.errors.push("Grupo Requerido.");
      }
      if (!this.FFechaISol) {
        this.errors.push("Fecha de Inicio de Solicitud Requerido.");
      }
      if (!this.FFechaFSol) {
        this.errors.push("Fecha Fin de Solicitud Requerido.");
      } else if (this.FFechaISol) {
        var date1 = new Date(this.FFechaISol);
        var date2 = new Date(this.FFechaFSol);
        if (date1.getTime() > date2.getTime()) {
          this.errors.push(
            "Fecha de Inicio de Solicitud Debe Ser Menor a Fecha Fin Solicitud"
          );
        }
      }
      if (this.horarios.length < 1) {
        this.errors.push("Al menos 1 Horario Requerido");
      }
      if (!this.FEstudiantes) {
        this.errors.push("Cantidad de Estudiantes Requerido.");
      }
      if (!this.errors.length) {
        this.NewForm();
        return true;
      }

      e.preventDefault();
    },
    validEmail: function(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    NewForm() {
      const params = {
        FNyA: this.FNyA,
        FProDoc: this.FProDoc,
        FCedula: this.FCedula,
        FCorreoUTP: this.FCorreoUTP,
        FCorreoAlt: this.FCorreoAlt,
        FCodAsignatura: this.FCodAsignatura,
        FNomAsignatura: this.FNomAsignatura,
        FGrupo: this.FGrupo,
        FFechaISol: this.FFechaISol,
        FFechaFSol: this.FFechaFSol,
        FEstudiantes: this.FEstudiantes,
        FSoftwareN: this.FSoftwareN,
        FEquipoA: ~~this.FEquipoA,
        horarios: this.horarios
      };
      axios.post("formulario", params).then(response => console.log(response));
      (this.FNyA = ""),
        (this.FProDoc = ""),
        (this.FCedula = ""),
        (this.FCorreoUTP = ""),
        (this.FCorreoAlt = ""),
        (this.FCodAsignatura = ""),
        (this.FNomAsignatura = ""),
        (this.FGrupo = ""),
        (this.FFechaISol = ""),
        (this.FFechaFSol = ""),
        (this.FDia = ""),
        (this.FHorarioD = ""),
        (this.FHorarioH = ""),
        (this.FEstudiantes = ""),
        (this.FSoftwareN = ""),
        (this.FEquipoA = ""),
        (this.horarios = []),
        (this.errors = []);
    },
    addSchedule(sche) {
      sche.timeIni = [
        ("0" + sche.timeIni.getHours()).slice(-2),
        ("0" + sche.timeIni.getMinutes()).slice(-2)
      ].join(":");
      sche.timeEnd = [
        ("0" + sche.timeEnd.getHours()).slice(-2),
        ("0" + sche.timeEnd.getMinutes()).slice(-2)
      ].join(":");
      this.horarios.push(sche);
    },
    setFechaI(date) {
      this.FFechaISol = [
        date.getFullYear(),
        date.getMonth(),
        date.getDate()
      ].join("-");
    },
    setFechaF(date) {
      this.FFechaFSol = [
        date.getFullYear(),
        date.getMonth(),
        date.getDate()
      ].join("-");
    },
    deleteSche(index) {
      this.horarios.splice(index, 1);
    },
    isNumber: function(evt) {
      evt = evt ? evt : window.event;
      var charCode = evt.which ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        evt.preventDefault();
      } else {
        return true;
      }
    }
  }
};
</script>
 
