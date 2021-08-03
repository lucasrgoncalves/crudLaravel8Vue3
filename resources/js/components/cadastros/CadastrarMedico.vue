<template>   
    <div v-if="tipo_btn_especialidade == 'post'">
            <cadastrar-especialidade/>
    </div>
    <div v-else-if="tipo_btn_especialidade != 'post'" class="container card mt-2 mb-2">
        <div class="card-header mt-2 bg-dark titulo-formulario">
            <strong class="text-left">CADASTRAR NOVO MÉDICO</strong>            
        </div>

        <div class="row text-right">
            <div class="col-lg-12 mt-1" style="text-align: right;">
                <a href="/" class="btn btn-primary"><i class="fas fa-fw fa-arrow-alt-circle-left"></i> Voltar</a>&nbsp;
                <a v-on:click="cadastrarEspecialidade()" class="btn btn-secondary"><i class="fas fa-fw fa-plus"></i> Especialidade</a>
            </div>
        </div><hr>

        <form class="form-group mb-2">   
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <strong>NOME</strong>
                        <input type="text" v-model="medico.nome" class="form-control" placeholder="Nome completo do médico">
                    </div>
                </div>

                <div class="col-6">
                    <div class="form-group">
                        <strong>E-MAIL</strong>
                        <input type="email" v-model="medico.email" class="form-control" placeholder="Informe um endereço de e-mail">
                    </div>
                </div>

                <div class="col-6 mt-2">
                    <div class="form-group">
                        <strong>CRM - Número</strong>
                        <input type="text" v-model="medico.crm_numero" maxlength="6" class="form-control" placeholder="Informe o número do CRM">
                    </div>
                </div>

                <div class="col-6 mt-2">
                    <div class="form-group">
                        <strong>CRM - UF</strong>
                        <input type="text" v-model="medico.crm_uf" maxlength="2" class="form-control" placeholder="Informe o estado do CRM">
                    </div>
                </div>

                <div class=" col-6 mt-2">
                    <strong>ESPECIALIDADE</strong>
                    <select class="form-control" v-model="opcaoespecialidade">
                        <option value="0"> Selecione uma Especialidade </option>
                        <option v-for="especialidade in especialidades" v-bind:value="especialidade.id" v-bind:key="especialidade.id">{{especialidade.nome_especialidade}}</option>
                    </select>
                </div>

                <div class=" col-6 mt-2">
                    <strong>ESTADO</strong>
                    <select class="form-control" v-model="opcaoestado" v-on:change="buscaCidadeEstado()">
                        <option value="0"> Selecione um Estado </option>
                        <option v-for="nome_estado in nome_estados" v-bind:value="nome_estado.id" v-bind:key="nome_estado.id">{{nome_estado.nome}}</option>
                    </select>
                </div>

                <div v-if="opcaoestado > 0" class="col-6 mt-2">
                    <strong>CIDADE</strong>
                    <select v-if="busca == 0" class="form-control" v-model="opcaocidade">
                        <option value="0"> Selecione uma Cidade </option>
                        <option v-for="nome_cidade in cidades" v-bind:value="nome_cidade.id" v-bind:key="nome_cidade.id">{{nome_cidade.nome}}</option>
                    </select>
                    <select v-else-if="opcaoestado > 0" class="form-control" v-model="opcaocidade">
                        <option value="0"> Selecione uma Cidade </option>
                        <option v-for="nome_cidade in busca" v-bind:value="nome_cidade.id" v-bind:key="nome_cidade.id">{{nome_cidade.nome}}</option>
                    </select>
                </div>

                <div class="col-6 mt-2">
                    <div class="form-group">
                        <strong>TELEFONE - Celular</strong>
                        <input type="text" v-model="medico.telefone_celular" maxlength="11" id="telefone_celular" class="form-control" placeholder="Informe um número de celular">
                    </div>
                </div>

                <div class="col-6 mt-2">
                    <div class="form-group">
                        <strong>TELEFONE - Fixo</strong>
                        <input type="text" v-model="medico.telefone_fixo" maxlength="10" id="telefone_fixo" class="form-control" placeholder="Informe um número de telefone fixo">
                    </div>
                </div><hr>

                <div v-if="tipo_requisicao == '0'" class="col-xs-12 col-sm-12 col-md-12 text-center mb-1">
                    <button type="button" class="btn btn-danger" v-on:click="limpaFormulario()">Limpar</button>&nbsp;
                    
                    <button v-if="medico.nome == '' || medico.email == '' || medico.crm_numero == '' || medico.crm_uf == '' || opcaoespecialidade == 0 || opcaoestado == 0 || opcaocidade == 0 || medico.telefone_celular == '' || medico.telefone_fixo == ''" type="button" class="btn btn-success" disabled>Cadastrar</button>

                    <button v-else type="button" v-on:click="salvaCadastro()" class="btn btn-success">Cadastrar</button>
                </div> 

                <div v-else-if="tipo_requisicao == '1'" class="col-xs-12 col-sm-12 col-md-12 text-center mb-1">
                    <button v-if="medico.nome == '' || medico.email == '' || medico.crm_numero == '' || medico.crm_uf == '' || opcaoespecialidade == 0 || opcaoestado == 0 || opcaocidade == 0 || medico.telefone_celular == '' || medico.telefone_fixo == ''" type="button" class="btn btn-success" disabled>Atualizar Cadastro</button>

                    <button v-else type="button" v-on:click="atualizaCadastro(medico)" class="btn btn-success">Atualizar Cadastro</button>
                </div> 

            </div>
        </form>
    </div>
</template>

<script> 

import axios from "axios";

import Swal from 'sweetalert2/dist/sweetalert2.js';
import 'sweetalert2/src/sweetalert2.scss';
import CadastrarEspecialidade from './CadastrarEspecialidade.vue';


export default {
    props:['compMedico', 'tipo_requisicao'],
    components: { CadastrarEspecialidade },
    watch: {
        'opcaoestado': function(){
            if(this.opcaoestado != this.medico.estados_id){
                this.opcaocidade = 0;
            }
        },
        'tipo': function(){
            if(this.tipo == 1){
                this.buscaCidades();
                this.medico = this.compMedico;
                this.opcaoestado = this.medico.estados_id;
                this.opcaocidade = this.medico.cidades_id;
                this.opcaoespecialidade = this.medico.especialidades[0].id;
            }
        }
    },
    data() {
        return {            
          medico:{
              nome:'',
              email:'',
              crm_numero:'',
              crm_uf:'',
              telefone_celular:'',
              telefone_fixo:''
          },
          tipo_btn_especialidade:'',
          nome_estados:{},
          nome_cidades:{},
          busca:{},
          opcaocidade:0,
          opcaoestado:0,
          opcaoespecialidade:0,
          especialidades:{},
          cidades:{},
          tipo:''
        }
    },
    created(){
        this.busca = 0;
        this.buscaEstados();
        this.buscaEspecialidades();
        this.tipo = this.tipo_requisicao;
        
    },
    methods: {
        limpaFormulario(){
            this.opcaoestado = 0;
            this.opcaocidade = 0;
            this.medico = {};
            this.opcaoespecialidade = 0;
            this.especialidades = {};
        },
        cadastrarEspecialidade(){
            this.tipo_btn_especialidade = 'post';
        },
        cadastroMedicos(){
            this.tipo_btn_especialidade = '';
            this.buscaEstados();
            this.buscaEspecialidades();
        },
        salvaCadastro(){            
            Swal.fire({
                title: 'Deseja mesmo SALVAR as Alterações?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/medicos', {nome:this.medico.nome, email:this.medico.email, crm_numero:this.medico.crm_numero, crm_uf:this.medico.crm_uf, cidades_id:this.opcaocidade,
                                            estados_id:this.opcaoestado, telefone_celular:this.medico.telefone_celular, telefone_fixo:this.medico.telefone_fixo, especialidade:this.opcaoespecialidade}
                    ).then((response) => {
                        if(response.data.status == "ok"){
                            Swal.fire('Médico Cadastrado com Sucesso!', 'Até a próxima!', 'success');
                            this.limpaFormulario();
                            this.buscaEstados();
                            this.buscaEspecialidades();
                        }
                    }).catch((err) => {
                        Swal.fire('Nenhuma alteração feita!', err.data.errors, 'error');
                    });
                } else if (result.isDenied) {
                    Swal.fire('Nenhuma alteração feita!', '', 'error');
                }
            })
        },
        atualizaCadastro(medico){            
            Swal.fire({
                title: 'Deseja mesmo SALVAR as Alterações?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.put('/medicos/'+medico.id, {nome:this.medico.nome, email:this.medico.email, crm_numero:this.medico.crm_numero, crm_uf:this.medico.crm_uf, cidades_id:this.opcaocidade,
                                            estados_id:this.opcaoestado, telefone_celular:this.medico.telefone_celular, telefone_fixo:this.medico.telefone_fixo, especialidade:this.opcaoespecialidade}
                    ).then((response) => {
                        if(response.data.status == "ok"){
                            Swal.fire('Médico Atualizado com Sucesso!', 'Até a próxima!', 'success');
                            this.$parent.listarMedicos();
                        }
                    }).catch((err) => {
                        Swal.fire('Nenhuma alteração feita!', err.data.errors, 'error');
                    });
                } else if (result.isDenied) {
                    Swal.fire('Nenhuma alteração feita!', '', 'error');
                }
            })
        },
        buscaEstados(){
            axios.get('/getEstados').then((response) => {
                this.nome_estados = response.data.result;
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...(funcao buscaEstados - ListaCidade!', err.data.errors, 'error');
            });
        },
        buscaCidadeEstado(){
            axios.get('/getCidadesPorEstado/'+this.opcaoestado).then((response) => {
                this.busca = response.data.result;
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
        buscaCidades(){
            axios.get('getCidades').then((response) => {
                this.cidades = response.data.result;
            }).catch((err) => {
                Swal.fire('Algo Não funcionou corretamente...', err.data.errors, 'error');
            });
        },
    },
}
</script>
