<template>
  <div class="window-height window-width q-pa-lg background_color">
    <div class="row justify-center">
      <div square class="shadow-24 size_expenses">
        <q-card-section class="bg-deep-purple-7">
          <h4 class="text-h5 text-white q-my-md">Controle de Despesas</h4>
        </q-card-section>
        <q-card class="bg-grey-4">
          <q-card-section>
            <div class="q-gutter-md">
              <q-input v-model="this.user" filled label="Usuário Logado" outlined readonly />
              <q-input v-model="description" filled label="Descrição" outlined />
              <q-select class="q-mt-md " v-model="category" filled label="Categoria" outlined :options="categoryOptions" />
              <q-input v-model="value" filled label="Valor" type="number" outlined />
              <q-input v-model="date" filled type="date" label="Data" />
            </div>
            <div class="q-gutter-md row items-end justify-end">
              <q-btn label="Adicionar Despesa" @click="addExpense" color="purple" class="q-mt-lg" />
            </div>
          </q-card-section>
          <q-table :rows="expenses" :columns="columns" row-key="id" class="q-mt-md" style="background-color: rgb(216, 213, 213);">
            <template v-slot:body-cell="props">
              <q-td v-if="props.col.name !== 'actions'">{{ props.value }}</q-td>
              <q-td v-else>
                <q-btn flat dense  icon="delete" @click="deleteExpense(props.row.id)" />
              </q-td>
            </template>
          </q-table>
        </q-card>
      </div>
    </div>
  </div>
</template>

<script>
import Cookie from 'js-cookie';
import { format } from 'date-fns';

export default {
  data() {
    return {
      id_user:'',
      user:'',
      description:'',
      category: '',
      value: '',
      date: '',
      categoryOptions: ["Alimentação", "Lazer", "Transporte", "Outros"],
    };
  },
  created(){
      this.user = Cookie.get('user_name');
      this.id_user = Cookie.get('id_user');
    },
  methods: {
    addExpense() {
      const register_expenses = {
        id_user: this.id_user ,
        user: this.user ,
        description: this.description ,
        category: this.category ,
        value: this.value ,
        date: this.date,
      };
      fetch(`http://127.0.0.1:8000/api/register_expenses`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Access': 'application/json',
          'Accept': 'application/json',
        },
        body: JSON.stringify(register_expenses)
      }).then(response => response.json())
        .then(res => {
          console.log(res);
          alert('Despesa adicionada com sucesso !');
        })
        .catch(error => {
           alert('algo deu errado');
        });

        this.description = "";
        this.category = "";
        this.value = "";
        this.date = "";
    },
    deleteExpense(expenseId) {
      const index = this.expenses.findIndex((expense) => expense.id === expenseId);

      if (index !== -1) {
        this.expenses.splice(index, 1);
      }
    },
  },
};
</script>

<style scoped>
</style>
