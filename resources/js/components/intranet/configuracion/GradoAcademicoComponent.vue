<template>
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <header class="card-header">
                        Grado Acemico
                        <button class="btn btn-primary float-right" @click="nuevo"><i class="fa fa-plus"></i> Nuevo</button>
                    </header>
                    <div class="card-body">
                        <!-- <button type="button" id="agregar-grado_academico-users" class="btn btn-secondary btn-sm">
                        <i class="fa fa-plus"></i> Agregar
                        </button>  -->
                        <v-server-table ref="table" :columns="columns" :options="options" url="/intranet/configuracion/grado_academico/lista/data">
                            <div slot="estado" slot-scope="props">
                                {{ props.row.estado == "1" ? "Activo" : "Inactivo" }}
                                <!-- <a href="#" @click="detalles(props.row.id)"><i class="fa fa-folder big-icon text-success" aria-hidden="true"></i></a> -->
                            </div>
                            <div slot="actions" slot-scope="props">
                                <!-- <a class="btn btn-sm btn-primary" href="#" >Detalles</a> -->
                                <button class="btn btn-sm btn-info" @click="editar(props.row.id)">
                                    Editar
                                </button>
                                <!-- <a href="#" @click="editar(props.row.id)"><i class="fa  fa-trash big-icon text-danger" aria-hidden="true"></i></a> -->
                            </div>
                        </v-server-table>
                    </div>
                </div>
            </div>
        </div>
        <form @submit.prevent="submit">
            <div
                class="modal fade"
                id="ModalFormulario"
                data-backdrop="static"
                data-keyboard="false"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ titulo }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="denominacion">Denominación</label>
                                        <input type="text" class="form-control" id="denominacion" v-model="fields.denominacion" />
                                        <div v-if="errors && errors.denominacion" class="text-danger">
                                            {{ errors.denominacion[0] }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from "axios";
import $ from "jquery";
import toastr from "toastr";
import "vue-select/dist/vue-select.css";

export default {
    // props:[],
    data() {
        return {
            ///table//
            edit: 0,
            id: 0,
            titulo: "",
            fields: {
                estado: "1",
                denominacion: ""
            },
            errors: {},
            sedes: [],
            columns: ["id", "denominacion", "actions"],
            options: {
                headings: {
                    id: "id",
                    denominacion: "Denominacion",
                    actions: "Acciones"
                },
                sortable: ["id", "denominacion"]
                // filterable: ['correlativo','num_mat','paterno'],
                // customFilters: ['correlativo','num_mat']
                // filterByColumn:true
            }
        };
    },

    methods: {
        nuevo: function() {
            this.edit = 0;
            this.errors = {};
            this.titulo = "Nuevo grado academico";
            this.fields.denominacion = "";
            this.fields.direccion = "";
            this.fields.nro_aulas = "";
            this.fields.sede = "";
            $("#ModalFormulario").modal("show");
        },
        editar: function(id) {
            this.edit = 1;
            this.id = id;
            this.errors = {};
            this.titulo = "Editar grado academico";
            axios.get("grado_academico/" + id + "/edit").then(response => {
                this.fields.denominacion = response.data.denominacion;
                this.fields.estado = response.data.estado;
            });
            $("#ModalFormulario").modal("show");
        },
        submit: function() {
            this.errors = {};
            if (this.edit == 0)
                axios
                    .post("grado_academico", this.fields)
                    .then(response => {
                        // $(".loader").hide();
                        if (response.data.status) {
                            this.$refs.table.refresh();
                            toastr.success(response.data.message);
                            $("#ModalFormulario").modal("hide");
                            // window.location.replace(response.data.url);
                        } else {
                            toastr.warning(response.data.message, "Aviso");
                        }
                    })
                    .catch(error => {
                        // $(".loader").hide();
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
            else {
                axios
                    .put("grado_academico/" + this.id, this.fields)
                    .then(response => {
                        // $(".loader").hide();
                        if (response.data.status) {
                            this.$refs.table.refresh();
                            toastr.success(response.data.message);
                            $("#ModalFormulario").modal("hide");
                            // window.location.replace(response.data.url);
                        } else {
                            toastr.warning(response.data.message, "Aviso");
                        }
                    })
                    .catch(error => {
                        // $(".loader").hide();
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    });
            }
            // console.log("hols");
        }
    },
    mounted() {}
};
</script>

<style></style>
