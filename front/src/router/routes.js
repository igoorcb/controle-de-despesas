import LoginPage from 'pages/LoginPage.vue';
import ExpensesControl from 'pages/ExpensesControl.vue';
import RegisterPage from 'pages/RegisterPage.vue';

const routes = [
  {
    path: '/',
    component: LoginPage,
  },
  {
    path: '/despesas',
    component: ExpensesControl,
  },
  {
    path: '/cadastro',
    component: RegisterPage,
  },
];
  export default routes
  