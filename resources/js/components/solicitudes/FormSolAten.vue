<style>
.hiddenRow {
  padding: 0 !important;
}
</style>
<template>
  <div class="table-responsive">
    <table class="table table-hover" style="border-collapse:collapse; ">
      <tbody>
        <tr
          data-toggle="collapse"
          :data-target="'#demo' + index"
          class="clickable collapse-row collapsed"
        >
          <td style="width: 20%">{{solicitud.FechaSol}}</td>
          <td style="width: 20%">{{solicitud.FNyA}}</td>
          <td style="width: 20%">{{solicitud.FNomAsignatura}}</td>
          <td style="width: 20%">{{solicitud.FFechaISol}}</td>
          <td style="width: 20%">{{solicitud.FFechaFSol}}</td>
        </tr>
        <tr>
          <td colspan="5" class="hiddenRow">
            <div v-bind:id="['demo'+index]" class="collapse">
              <div class="container-fluid card" style="background-color: lightgray">
                <div class="card-body row">
                  <div class="col-4">
                    <h6>
                      <label>
                        <b>Cédula:</b>
                        {{solicitud.FCedula}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Programa Docente:</b>
                        {{solicitud.FProDoc}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Correo:</b>
                        {{solicitud.FCorreoUTP}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Correo Alterno:</b>
                        {{solicitud.FCorreoAlt}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Código Asignatura:</b>
                        {{solicitud.FCodAsignatura}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Grupo:</b>
                        {{solicitud.FGrupo}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Cantidad de Estudiantes:</b>
                        {{solicitud.FEstudiantes}}
                      </label>
                    </h6>
                    <h6>
                      <label>
                        <b>Software Necesario:</b>
                        {{solicitud.FSoftwareN}}
                      </label>
                    </h6>
                  </div>
                  <span class="border-right border-white col-6">
                    <h6>
                      <label>
                        <b>Horarios Requeridos:</b>
                      </label>
                    </h6>
                    <div class="row">
                      <div class="col-3">
                        <label>
                          <b>Día:</b>
                        </label>
                      </div>
                      <div class="col-3">
                        <label>
                          <b>Desde:</b>
                        </label>
                      </div>
                      <div class="col-3">
                        <label>
                          <b>Hasta:</b>
                        </label>
                      </div>
                      <div class="col-3">
                        <label>
                          <b>Sala:</b>
                        </label>
                      </div>
                    </div>
                    <div class="row" v-for="horario in myHorarios" :key="horario.idMásHorarios">
                      <div class="col-3">
                        <label for>{{horario.MDia}}</label>
                      </div>
                      <div class="col-3">
                        <label for>{{horario.MHorarioD}}</label>
                      </div>
                      <div class="col-3">
                        <label for>{{horario.MHorarioH}}</label>
                      </div>
                    </div>
                  </span>
                  <div
                    class="col-2"
                    style="display: flex; align-items: center; justify-content: center;"
                  >
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-primary" @click.prevent="asignar">Notificar</button>
                      <button type="button" class="btn btn-secondary" @click.prevent="edit">Editar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="modal fade" :id="'edit' + index" aria-hidden="true" @hidde="recargar">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <formuEdit-component :solicitud="solicitud" :horariosreq="myHorarios" :idF="idF" @new="recargar"></formuEdit-component>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true" @click.prevent="recargar">&times;</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["index", "solicitud", "horarios", "idF"],
  data() {
    return {
      myHorarios: []
    };
  },

  mounted() {
    this.myHor();
  },
  methods: {
    myHor() {
      for (const horario in this.horarios) {
        if (this.horarios[horario].idF === this.idF) {
          this.myHorarios.push(this.horarios[horario]);
        }
      }
    },
    edit() {
      $("#edit" + this.index).modal("show");
    },
    recargar() {
      $("#edit" + this.index).modal("hide");
      this.$emit("new");
    }
  }
};
</script>