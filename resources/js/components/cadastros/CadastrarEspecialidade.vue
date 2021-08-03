<template>

    <div class="container card mt-2 mb-2">
        <div class="card-header mt-2 bg-dark titulo-formulario">
            <strong class="text-left">CADASTRAR NOVA ESPECIALIDADE</strong>            
        </div>
        <div class="row text-right">
            <div class="col-lg-12 mt-1" style="text-align: right;">
                <a v-on:click="voltar()" class="btn btn-primary"><i class="fas fa-fw fa-arrow-alt-circle-left"></i> Voltar</a>
            </div>
        </div><hr>

        <form class="form-group" enctype="multipart/form-data">   
            <div class="row mt-2 mb-2">
                <div class="col-6">
                    <div class="form-group">
                        <strong>NOME</strong>
                        <input type="text" v-model="especialidade.nome_especialidade" class="form-control" placeholder="Informe o nome da especialidade">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <strong>DESCRIÇÃO</strong>
                        <input type="text" v-model="especialidade.descricao" class="form-control" placeholder="Informe uma descrição para a especialidade">
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-3">
                    <button type="button" class="btn btn-danger" v-on:click="limpaFormulario()">Limpar</button>&nbsp;
                    
                    <button v-if="especialidade.nome_especialidade == '' || especialidade.descricao == ''" type="button" class="btn btn-success submit-form" disabled>Cadastrar</button>

                    <button v-else type="button" v-on:click="salvaEspecialidade()" id="submit-form" class="btn btn-success submit-form">Cadastrar</button>
                </div>            
                
            </div>
        </form>
    </div>
</template>

<script>

import axios from "axios";

import Swal from 'sweetalert2/dist/sweetalert2.js';
import 'sweetalert2/src/sweetalert2.scss';

export default {
    data() {
        return {            
          especialidade:{
              nome_especialidade:'',
              descricao:''
          }
        }
    },
    created(){
        //
    },
    methods: {
        limpaFormulario(){
            this.especialidade = {};
        },
        salvaEspecialidade(){            
            Swal.fire({
                title: 'Deseja mesmo SALVAR?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Sim',
                denyButtonText: 'Não',
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/especialidades', {nome_especialidade:this.especialidade.nome_especialidade, descricao:this.especialidade.descricao}
                    ).then((response) => {
                        if(response.data.status == "ok"){
                            Swal.fire('Especialidade Cadastrada com Sucesso!', 'Até a próxima!', 'success');
                            this.limpaFormulario();
                            //$("#formulario").modal('toggle');
                        }
                    }).catch((err) => {
                        Swal.fire('Nenhuma alteração feita!', err.data.errors, 'error');
                    });
                } else if (result.isDenied) {
                    Swal.fire('Nenhuma alteração feita!', '', 'error');
                }
            })
        },
        voltar(){
            this.$parent.cadastroMedicos();
        },
    }
}
</script>
