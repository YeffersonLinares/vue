<template>
  <div>
    <form>
      <div class="row container">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <input type="date" class="form-control mb-3" v-model="nota.date" />

          <textarea
            class="form-control mb-3"
            maxlength="499"
            v-model="nota.description"
          >
          </textarea>
          <button
            type="button"
            class="btn btn-success btn-lg"
            @click="crear_nota()"
          >
            cambio
          </button>
        </div>
      </div>
    </form>
    <div class="container mt-5">
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Descripción</th>
              <th scope="col">Fecha</th>
              <th scope="col">Usuario</th>
              <th scope="col">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(i, index) in notas" :key="index">
              <td>{{ i.description }}</td>
              <td>{{ i.creation_date }}</td>
              <td>{{ i.user_nombre }}</td>
              <td>
                <button @click="edit_nota(i,index)" class="btn btn-warning">Editar</button>
                <button @click="eliminar_nota(i, index)" class="btn btn-danger">
                  Eliminar
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      notas: [],
      nota: { description: '', date: '', id: 0, },
       index: 0
    };
  },
  created() {
    let url = "/index";
    axios.get(url).then((res) => {
      this.notas = res.data.notas;
    });
  },
  methods: {
    eliminar_nota(nota, index) {
      let url = "/index_eliminar";
      axios.post(url, nota).then((res) => {
        if (res.data.status == 200) {
          this.notas.splice(index, 1);
          alert(res.data.msg);
        } else {
        }
      });
    },
    crear_nota() {
      let url = "/index_crear";
      if (
        this.nota.date == "" ||
        this.nota.description == "" ||
        this.nota.date == null ||
        this.nota.description == null
      ) {
        alert("entre datos");
      } else {
        let nota = this.nota;
        axios.post(url, nota).then((res) => {
            console.log(res.data);
          if (res.data.status == 200) {
              if(res.data.idEdit == 0){
                  this.notas.push(res.data.notaP);
              }else{
                  this.notas[this.index] = res.data.notaP
                  this.notas[this.index].user_nombre = res.data.user.name
              }
            this.nota = { description: '', date: '', id: 0, }
            this.index = 0
            alert(res.data.msg);
          } else {
          }
        });
      }
    },
    edit_nota(nota, index){
        this.nota.description = nota.description
        this.nota.date = nota.creation_date
        this.nota.id = nota.id
        this.index = index
    },
  },
};
</script>
