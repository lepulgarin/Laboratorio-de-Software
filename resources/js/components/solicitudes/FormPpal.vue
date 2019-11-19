<style>
.scroll {
  max-height: 100vh;
  overflow-y: auto;
}
</style>
<template>
  <div class="container-fluid">
    <div class="row flex-xl-nowrap" style="height:100vh">
      <div class="card col-xs-2 bd-sidebar">
        <div
          class="nav flex-column nav-pills"
          id="v-pills-tab"
          role="tablist"
          aria-orientation="vertical"
        >
          <a
            class="nav-link active"
            id="v-pills-pendiente-tab"
            data-toggle="pill"
            href="#v-pills-pendientes"
            role="tab"
            aria-controls="v-pills-pendientes"
            aria-selected="true"
          >Solicitudes Pendientes</a>
          <a
            class="nav-link"
            id="v-pills-atendida-tab"
            data-toggle="pill"
            href="#v-pills-atendidas"
            role="tab"
            aria-controls="v-pills-atendidas"
            aria-selected="false"
          >Solicitudes Atendidas</a>
          <a
            class="nav-link"
            id="v-pills-asignadas-tab"
            data-toggle="pill"
            href="#v-pills-asignadas"
            role="tab"
            aria-controls="v-pills-asignadas"
            aria-selected="false"
          >Solicitudes Asignadas</a>
        </div>
      </div>
      <div class="col-md-10">
        <div class="tab-content" id="v-pills-tabContent">
          <div
            class="tab-pane fade show active"
            id="v-pills-pendientes"
            role="tabpanel"
            aria-labelledby="v-pills-pendientes-tab"
          >
            <div class="card" style="height:100vh;">
              <div class="card-header">Solicitudes Pendientes</div>
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 20%">Fecha Solicitud</th>
                    <th style="width: 20%">Nombre</th>
                    <th style="width: 20%">Asignatura</th>
                    <th style="width: 20%">Fecha Inicio</th>
                    <th style="width: 20%">Fecha Fin</th>
                  </tr>
                </thead>
              </table>
              <div class="scroll">
                <div v-for="(solicitud,index) in sol_pendientes" :key="index">
                  <solPen-component
                    :key="recharge"
                    :idF="solicitud.idF"
                    :index="index"
                    :solicitud="solicitud"
                    :horarios="hor_pendientes"
                    :salas="salas"
                    @new="recargar"
                  ></solPen-component>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="v-pills-atendidas"
            role="tabpanel"
            aria-labelledby="v-pills-atendidas-tab"
          >
            <div class="card" style="height:100vh;">
              <div class="card-header">Solicitudes Atendidas</div>
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 20%">Fecha Solicitud</th>
                    <th style="width: 20%">Nombre</th>
                    <th style="width: 20%">Asignatura</th>
                    <th style="width: 20%">Fecha Inicio</th>
                    <th style="width: 20%">Fecha Fin</th>
                  </tr>
                </thead>
              </table>
              <div class="scroll">
                <div v-for="(solicitud,index) in sol_atendidas" :key="index">
                  <solAten-component
                    :key="recharge"
                    :idF="solicitud.idF"
                    :index="index"
                    :solicitud="solicitud"
                    :horarios="hor_atendidas"
                    @new="recargar"
                  ></solAten-component>
                </div>
              </div>
            </div>
          </div>
          <div
            class="tab-pane fade"
            id="v-pills-asignadas"
            role="tabpanel"
            aria-labelledby="v-pills-asignadas-tab"
          >
            <div class="card" style="height:100vh;">
              <div class="card-header">Solicitudes Asignadas</div>
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 20%">Fecha Solicitud</th>
                    <th style="width: 20%">Nombre</th>
                    <th style="width: 20%">Asignatura</th>
                    <th style="width: 20%">Fecha Inicio</th>
                    <th style="width: 20%">Fecha Fin</th>
                  </tr>
                </thead>
              </table>
              <div class="scroll">
                <div v-for="(solicitud,index) in sol_asignadas" :key="index">
                  <solAsig-component
                    :key="recharge"
                    :idF="solicitud.idF"
                    :index="index"
                    :solicitud="solicitud"
                    :horarios="hor_asignadas"
                    @new="recargar"
                  ></solAsig-component>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todas: [],
      solicitudes: [],
      solicitudesPen: [],
      solicitudesAten: [],
      solicitudesAsig: [],
      sol_pendientes: [],
      sol_atendidas: [],
      sol_asignadas: [],
      horarios: [],
      hor_pendientes: [],
      hor_atendidas: [],
      hor_asignadas: [],
      horas: [],
      salas: [],
      recharge: 0
    };
  },
  mounted() {
    this.getSolicitudes();
  },
  methods: {
    getSolicitudes() {
      var urlSolicitudes = "solicitudes";
      axios.get(urlSolicitudes).then(response => {
        this.todas = response.data;
        this.solicitudes = this.todas[0];
        this.solicitudesPen = this.todas[1].data;
        this.solicitudesAten = this.todas[2].data;
        this.solicitudesAsig = this.todas[3].data;
        this.horarios = this.todas[4].data;
        this.horas = this.todas[5].data;
        this.salas = this.todas[6].data;
        this.lists();
      });
    },
    lists() {
      for (const solicitud in this.solicitudes) {
        if (
          this.solicitudesPen.some(
            sol => sol["idF"] === this.solicitudes[solicitud].idF
          )
        ) {
          this.sol_pendientes.push(this.solicitudes[solicitud]);
        } else if (
          this.solicitudesAten.some(
            sol => sol["idF"] === this.solicitudes[solicitud].idF
          )
        ) {
          this.sol_atendidas.push(this.solicitudes[solicitud]);
        } else if (
          this.solicitudesAsig.some(
            sol => sol["idF"] === this.solicitudes[solicitud].idF
          )
        ) {
          this.sol_asignadas.push(this.solicitudes[solicitud]);
        }
      }
      for (const horario in this.horarios) {
        if (
          this.solicitudesPen.some(
            sol => sol["idF"] === this.horarios[horario].idF
          )
        ) {
          this.hor_pendientes.push(this.horarios[horario]);
        } else if (
          this.solicitudesAten.some(
            sol => sol["idF"] === this.horarios[horario].idF
          )
        ) {
          this.hor_atendidas.push(this.horarios[horario]);
        } else if (
          this.solicitudesAsig.some(
            sol => sol["idF"] === this.horarios[horario].idF
          )
        ) {
          this.hor_asignadas.push(this.horarios[horario]);
        }
      }
    },
    recargar() {
      Object.assign(this.$data, this.$options.data())
      this.recharge += 1;
      this.getSolicitudes();
    }
  }
};
</script>