<style>
.hiddenRow {
  padding: 0 !important;
}
</style>
<template>
  <div class="table-responsive">
    <table class="table table-hover" style="border-collapse:collapse; ">
      <tbody style=" box-shadow: 0px 10px 8px -6px rgba(0, 0, 0, 0.2);">
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
                        {{solicitud.FCorreoUTP}}@utp.edu.co
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
                    <div class="row" v-for="(horario,index1) in myHorarios" :key="index1">
                      <div class="col-3">
                        <label for>{{horario.MDia}}</label>
                      </div>
                      <div class="col-3">
                        <label for>{{horario.MHorarioD}}</label>
                      </div>
                      <div class="col-3">
                        <label for>{{horario.MHorarioH}}</label>
                      </div>
                      <div class="col-3">
                        <div class="dropdown">
                          <button
                            class="btn btn-secondary btn-sm dropdown-toggle"
                            type="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                          >{{horario.sala}}</button>
                          <ul class="dropdown-menu">
                            <div class="scroll" style="max-height:150px;">
                              <li
                                class="dropdown-item"
                                v-for="(sala,index) in horario.salas"
                                :key="index"
                                @click="cambiarSala(horario,sala.Nombre,index1)"
                              >{{sala.Nombre}}</li>
                            </div>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </span>
                  <div
                    class="col-2"
                    style="display: flex; align-items: center; justify-content: center;"
                  >
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click.prevent="notificar"
                        v-if="(cambio === 1)"
                      >Asignar</button>
                      <button
                        type="button"
                        class="btn btn-primary"
                        @click.prevent="aplicar"
                        v-if="(cambio === 0)"
                      >Aplicar</button>
                      <button
                        type="button"
                        class="btn btn-secondary"
                        @click.prevent="edit"
                        v-if="(cambio === 1)"
                      >Editar</button>
                      <button
                        type="button"
                        class="btn btn-secondary"
                        @click.prevent="cancelar"
                        v-if="(cambio === 0)"
                      >Cancelar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <div class="modal fade" :id="'editAten' + index" aria-hidden="true" @hidde="recargar">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <formuEdit-component
              :solicitud="solicitud"
              :horariosreq="myHorarios"
              :idF="idF"
              @new="recargar"
            ></formuEdit-component>
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
  props: ["index", "solicitud", "horarios", "idF", "salas", "horas"],
  data() {
    return {
      myHorarios: [],
      myHoras: [],
      cambio: 1
    };
  },

  mounted() {
    this.myHorAten();
    this.mySal();
  },
  methods: {
    myHorAten() {
      this.horarios.map(horario => {
        if (horario.idF === this.idF) {
          let sal;
          sal = this.horas.find(
            hora =>
              hora.idF === horario.idF &&
              hora.dia === horario.MDia &&
              hora.hora === horario.MHorarioD
          );
          var tmp = { sala: sal.sala };
          Object.assign(horario, tmp);
          tmp = { salas: [] };
          Object.assign(horario, tmp);
          horario.salas = [];
          this.myHorarios.push(horario);
        }
      });
    },
    mySal() {
      this.myHorarios.forEach(horario => {
        this.salas.forEach(sala => {
          if (sala.Nequipos > this.solicitud.FEstudiantes) {
            if (!(this.solicitud.FEquipoA === 1 && sala.VideoBeam === 0)) {
              if (this.horas.some(hora => hora.sala === sala.Nombre)) {
                if (
                  this.horas.some(
                    hora =>
                      hora.dia === horario.MDia && hora.sala === sala.Nombre
                  )
                ) {
                  var tmp;
                  tmp = this.horas.filter(
                    hora =>
                      hora.hora >= horario.MHorarioD &&
                      hora.sala === sala.Nombre
                  );
                  if (tmp.length > 0) {
                    tmp.sort(function(a, b) {
                      if (a.hora > b.hora) return 1;
                      else return -1;
                    });
                    var horaReq = this.restarHoras(
                      horario.MHorarioD,
                      horario.MHorarioH
                    );
                    var horaDis = this.restarHoras(
                      horario.MHorarioD,
                      tmp[0].hora
                    );
                    if (horaDis > horaReq) {
                      horario.salas.push(sala);
                    }
                  } else {
                    horario.salas.push(sala);
                  }
                } else {
                  horario.salas.push(sala);
                }
              } else {
                horario.salas.push(sala);
              }
            }
          }
        });
      });
    },
    edit() {
      $("#editAten" + this.index).modal("show");
    },
    recargar() {
      $("#editAten" + this.index).modal("hide");
      this.$emit("new");
    },
    notificar() {
      axios
        .post("mail", { horarios: this.myHorarios })
        .then(response => this.$emit("new"));
    },
    cambiarSala(horario, sala, index) {
      horario.sala = sala;
      Vue.set(this.myHorarios, index, horario);
      this.cambio = 0;
    },
    cancelar() {
      this.myHorarios = [];
      this.myHorAten();
      this.mySal();
      this.cambio = 1;
    },
    aplicar() {
      axios
        .post("horarios", { horarios: this.myHorarios })
        .then(response => this.$emit("new"));
    },
    restarHoras(inicio, fin) {
      var inicioMinutos = parseInt(inicio.substr(3, 2));
      var inicioHoras = parseInt(inicio.substr(0, 2));

      var finMinutos = parseInt(fin.substr(3, 2));
      var finHoras = parseInt(fin.substr(0, 2));

      var transcurridoMinutos = finMinutos - inicioMinutos;
      var transcurridoHoras = finHoras - inicioHoras;

      if (transcurridoMinutos < 0) {
        transcurridoHoras--;
        transcurridoMinutos = 60 + transcurridoMinutos;
      }

      var horas = transcurridoHoras.toString();
      var minutos = transcurridoMinutos.toString();

      if (horas.length < 2) {
        horas = "0" + horas;
      }

      if (minutos.length < 2) {
        minutos = "0" + minutos;
      }

      return horas + ":" + minutos;
    }
  }
};
</script>