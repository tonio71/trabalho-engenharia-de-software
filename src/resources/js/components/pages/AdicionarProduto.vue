<template>
  <div>
    <h3 class="text-center">Adicionar produto</h3>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div>
          <b-alert show dismissible v-model="showAlert" variant="danger">Ocorreu um erro na validação dos dados. Verifique se foram inseridos dados compatíveis aos campos.</b-alert>
        </div>
        <b-form @submit.prevent="adicionarProduto">
          <b-form-group
            label="Nome do produto:"
            label-for="nome_produto"
            description="Insira o nome do produto."
          >
            <b-form-input id="nome_produto" v-model="produto.nome" required></b-form-input>
          </b-form-group>
          <b-form-group label="NCM:" label-for="ncm" description="Insira apenas os 8 números.">
            <b-form-input id="ncm" v-model="produto.ncm" required></b-form-input>
          </b-form-group>
          <b-form-group
            label="Preço do produto:"
            label-for="preco"
            description="Insira o preço separando centavos com um ponto"
          >
            <b-form-input id="preco" v-model="produto.valor" required></b-form-input>
          </b-form-group>
          <b-form-group
            label="Quantidade:"
            label-for="encargo"
            description="Quantidade de unidades do produto."
          >
            <b-form-input id="quantidade" v-model="produto.quantidade" required></b-form-input>
          </b-form-group>
          <b-button type="submit" variant="primary">Adicionar produto</b-button>
          <b-button type="button" to="/lista-produtos" variant="outline-primary">Voltar</b-button>
        </b-form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      usuario: {
        email: '',
        senha: ''
      },
      produto: {},
      showAlert: false
    };
  },
  created() {
    this.usuario.email = JSON.parse(sessionStorage.getItem('email'));
    this.usuario.senha = JSON.parse(sessionStorage.getItem('senha'));

    if (!this.usuario.email || !this.usuario.senha){
      this.$router.push({name: 'login'})
    }
  },

  methods: {
    adicionarProduto() {
      this.axios
        .post("http://localhost:8000/api/produto/adicionar", this.produto)
        .then(
          (response) => (
            this.$router.push({ name: "lista-produtos" }),
            console.log(response.data)
          )
        )
        .catch((error) => {
          this.showAlert = true;
          console.log(error.response);
        })
        .finally(() => (this.loading = false));
    },
  },
};
</script>
