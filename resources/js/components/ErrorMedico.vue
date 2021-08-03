<template>
    <div v-if="tipo_btn_inicio == 'post'">
        <cadastrar-medico :tipo_requisicao="0"/>
    </div>
    <div v-else class="alert alert-danger mt-1 mb-1 text-center" role="alert">
        <h3 class="alert-heading">OOPS!</h3>
        <p>Desculpe, no momento <b>NÃO HÁ NENHUM</b> Médico Cadastrado!</p>
        <hr>
        <p class="mb-2">Clique no botão abaixo e inicie o primeiro cadastro!.</p>
        <a v-on:click="criarMedico()" class="btn btn-success"><i class="fas fa-fw fa-plus"></i> Cadastrar Medico</a>
    </div>
</template>

<script>

import 'sweetalert2/src/sweetalert2.scss';
import CadastrarMedico from './cadastros/CadastrarMedico.vue';

export default {
    components: { CadastrarMedico },//
    data() {
        return {
            tipo_btn_inicio:''
        }
    },
    created(){
        //
    },
    methods: {
        criarMedico(){
            this.tipo_btn_inicio = 'post';
        },
    }
}
</script>