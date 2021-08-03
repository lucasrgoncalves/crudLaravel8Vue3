<template>
    <div v-if="tipo_btn == 'put'">
        <cadastrar-medico :compMedico="medico" :tipo_requisicao="1"/>
    </div>
    <div v-if="tipo_btn == 'post'">
        <cadastrar-medico :tipo_requisicao="0"/>
    </div>
    <div v-if="tipo_btn != 'put' && tipo_btn != 'post'">
        <div class="card-header mt-2 bg-dark titulo">
            <strong class="text-left">CADASTRO DE MÉDICOS</strong>
            <a v-on:click="cadastrarMedico()" class="btn btn-light float-right"><i class="fas fa-fw fa-plus"></i> Medico</a>
        </div>

        <table class="table table-striped table-sm table-bordered">
            <caption>Listando Médicos Cadastrados.</caption>
            
            <thead  class="bg-secondary titulo-tabela">
                <tr>
                    <th>#</th>
                    <th>NOME</th> 
                    <th>ESPECIALIDADE</th>                                 
                    <th>TEL. CELULAR</th>                              
                    <th>TEL. FIXO</th>                              
                    <th>CIDADE</th>                                  
                    <th>ESTADO</th>                                  
                    <th>EMAIL</th>                                  
                    <th>CRM</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tr v-for="medico in medicos" v-bind:key="medico.id">
                <td style="text-align:center">{{ medico.id }}</td>
                <td style="text-align:center">{{ medico.nome }}</td>
                <td style="text-align:center">{{ medico.especialidades[0].nome_especialidade }}</td>
                <td style="text-align:center">{{ medico.telefone_celular }}</td>
                <td style="text-align:center">{{ medico.telefone_fixo }}</td>
                <td style="text-align:center">{{ medico.cidademedico.nome }}</td>
                <td style="text-align:center">{{ medico.estadomedico.nome }}</td>
                <td style="text-align:center">{{ medico.email }}</td>
                <td style="text-align:center">{{ medico.crm_numero }}-{{medico.crm_uf}}</td>
                <td style="text-align:center">
                    <a v-on:click="editarMedico(medico)" class="btn btn-info mr-1"><i class="fas fa-fw fa-edit"></i></a>
                    <button class="btn btn-danger" v-on:click="deleteMedico(medico.id)" ><i class="fas fa-fw fa-trash-alt"></i></button>
                </td>            
            </tr>
        </table>
    </div>    
    
</template>

<script>

import axios from "axios";

import Swal from 'sweetalert2/dist/sweetalert2.js';
import 'sweetalert2/src/sweetalert2.scss';
import CadastrarMedico from './cadastros/CadastrarMedico.vue';
import ErrorMedico from './ErrorMedico.vue';

export default {
    components: { CadastrarMedico, ErrorMedico },
    data() {
        return {
            opcaoestado:0,
            opcaocidade:0,
            opcaoespecialidade:0,
            opcaoestadoedit:0,
            opcaocidadeedit:0,
            opcaoespecialidadeedit:0,
            estados:{},
            cidades:{},
            medicos:{},
            qtdemedicoscadastrados:0,
            medicoedit:{},
            tipo_btn:''
        }
    },
    created(){
        this.buscaEstados();
        this.buscaCidades();
        this.buscaMedicos();
    },
    methods: {
        buscaEstados(){
            axios.get('getEstados').then((response) => {
                this.estados = response.data.result;
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...', err.data.errors, 'error');
            });
        },
        buscaCidades(){
            axios.get('getCidades').then((response) => {
                this.cidades = response.data.result;
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...', err.data.errors, 'error');
            });
        },
        buscaCidadeEstado(){
            axios.get('/getCidadesPorEstado/'+this.opcaoestado).then((response) => {
                this.busca = response.data.result;
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...', err.data.errors, 'error');
            });
        },
        buscaMedicos(){
            axios.get('getMedicos').then((response) => {
                this.medicos = response.data.result;
                this.medicoedit = response.data.result[0];
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...', err.data.errors, 'error');
            });
        },
        buscaEspecialidades(){
            axios.get('/getEspecialidades').then((response) => {
                this.especialidades = response.data.result;
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...(funcao buscaEstados - ListaCidade!', err.data.errors, 'error');
            });
        },
        deleteMedico(id){
            Swal.fire({
                title: 'Deseja mesmo EXCLUIR?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/medicos/'+id).then((response) => {
                        if(response.data.status == "ok"){
                            Swal.fire('Médico Excluído com Sucesso!', 'Até a próxima!', 'success');
                            this.buscaMedicos();
                        }
                    }).catch((err) => {
                        Swal.fire('Nenhuma alteração feita!', err.data.errors, 'error')
                    });
                } else if (result.isDenied) {
                    Swal.fire('Nenhuma alteração feita!', '', 'error')
                }
            })
        },
        editarMedico(medico){
            this.medico = medico;
            this.tipo_btn = 'put';
        },
        cadastrarMedico(){
            this.tipo_btn = 'post';
        },
        listarMedicos(){
            this.tipo_btn = '';
            this.buscaEstados();
            this.buscaCidades();
            this.buscaMedicos();
            this.buscaQtdeMedicosCadastrados();
        }
    }
}
</script>