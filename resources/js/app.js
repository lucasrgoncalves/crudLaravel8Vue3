import { createApp } from 'vue';

//Declarando componentes
//import App from './components/App.vue';
import CadastrarMedico from './components/cadastros/CadastrarMedico.vue';
import ListarMedicos from './components/ListarMedicos.vue';
import ErrorMedico from './components/ErrorMedico.vue';
import CadastrarEspecialidade from './components/cadastros/CadastrarEspecialidade.vue';

//Montando componente com base no ID que será utilizado na view
createApp(CadastrarMedico).mount("#cadastrar-medico");
createApp(ListarMedicos).mount("#listar-medicos");
createApp(ErrorMedico).mount("#error-medico");
createApp(CadastrarEspecialidade).mount("#cadastrar-especialidade");