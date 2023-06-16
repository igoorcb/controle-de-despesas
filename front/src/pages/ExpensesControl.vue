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
              <q-input v-model="this.user" filled label="Usuário Logado" outlined />
              <q-input v-model="newExpense.description" filled label="Descrição" outlined />
              <q-select class="q-mt-md " v-model="newExpense.category" filled label="Categoria" outlined :options="categoryOptions" />
              <q-input v-model="newExpense.amount" filled label="Valor" type="number" outlined />
              <q-input v-model="newExpense.date" filled type="date" label="Data" />
            </div>
            <div class="q-gutter-md row items-end justify-end">
              <q-btn label="Adicionar Despesa" @click="addExpense" color="purple" class="q-mt-lg" />
            </div>
          </q-card-section>
          <q-table :rows="expenses" :columns="columns" row-key="id" class="q-mt-md" style="background-color: rgb(216, 213, 213);">
            <template v-slot:body-cell="props">
              <q-td v-if="props.col.name !== 'actions'">{{ props.value }}</q-td>
              <q-td v-else>
                <q-btn flat dense style="background-color: red;" icon="mdi-delete" @click="deleteExpense(props.row.id)" />
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
      newExpense: {
        description: "",
        amount: "",
        date: "",
        category: "",
      },
      expenses: [],
      columns: [
        {
          name: "user",
          required: true,
          label: "Usuário",
          align: "left",
          field: "user",
          sortable: true,
        },
        {
          name: "description",
          required: true,
          label: "Descrição",
          align: "left",
          field: "description",
          sortable: true,
        },
        {
          name: "category",
          required: true,
          label: "Categoria",
          align: "left",
          field: "category",
          sortable: true,
        },
        {
          name: "amount",
          required: true,
          label: "Valor",
          align: "left",
          field: "amount",
          sortable: true,
        },
        {
          name: "date",
          required: true,
          label: "Data",
          align: "left",
          field: "date",
          sortable: true,
        },
        { name: "actions", label: "Ações", align: "center", field: "actions" },
      ],
      categoryOptions: ["Alimentação", "Lazer", "Transporte", "Outros"],
    };
  },
  created(){
      this.user = Cookie.get('user_name');
    },
  methods: {
    addExpense() {
      if (!this.newExpense.description || !this.newExpense.amount || !this.newExpense.date) {
        return;
      }
      const newId = this.expenses.length + 1;
      const formattedDate = format(new Date(this.newExpense.date), 'dd/MM/yyyy');
      const formattedAmount = Number(this.newExpense.amount).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });


      this.expenses.push({
        id: newId,
        user: this.user,
        description: this.newExpense.description,
        amount: formattedAmount,
        date: formattedDate,
        category: this.newExpense.category,
      });

      this.newExpense.user = "";
      this.newExpense.category = "";
      this.newExpense.amount = "";
      this.newExpense.date = "";
    },
    editExpense(expense) {
      console.log("Editar despesa:", expense);
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
