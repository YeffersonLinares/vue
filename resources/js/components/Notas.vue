<template>
  <div>
    <form>
      <div class="row container">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
          <input type="date" class="form-control mb-3" />

          <textarea class="form-control mb-3" maxlength="499"> </textarea>
          <button type="submit" class="btn btn-success btn-lg">cambio</button>
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
            </tr>
          </thead>
          <tbody>
            <tr :key="index" v-for="(i,index) in notas" >
              <td>{{i.description}}</td>
              <td >{{i.creation_date}}</td>
              <td>{{i.user_id}}</td>
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
    return { notas: [], nota: {} };
  },
  created() {
      let url = '/index';
      axios.get(url).then(res => {  
           this.notas  = res.data;

          console.log(res.data);
      });
  }
};
</script>