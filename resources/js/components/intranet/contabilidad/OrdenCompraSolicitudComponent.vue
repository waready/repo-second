<template>
    <div>
        <vue-confirm-dialog></vue-confirm-dialog>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <header class="card-header">
                        Lista de Contratos
                        <!-- <button class="btn btn-primary float-right" @click="nuevo">
                            <i class="fa fa-plus"></i> Nuevo
                        </button> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"  @click="GenerarAll()">
                            Generador Masivo
                        </button>
                    </header>
                    <div class="card-body">
                        <v-server-table ref="table" :columns="columns" :options="options" url="/intranet/contabilidad/contrato/lista/data">
                            <div slot="actions" slot-scope="props">
                                <button type="button" class="p-0 m-0 h5 btn btn-link text-info" @click="editarContrato(props.row.id)">
                                    <i class="fas fa-file-signature"></i>
                                </button>
                                <button type="button" class="p-0 m-0 h5 btn btn-link text-danger" @click="eliminarContrato(props.row.id)">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <div slot="descripcion" slot-scope="props">
                                <template v-if="props.row.descripcion">
                                    {{ truncateDescription(props.row.descripcion, 30) }}
                                </template>

                                <!-- <a href="#" @click="detalles(props.row.id)"><i class="fa fa-folder big-icon text-success" aria-hidden="true"></i></a> -->
                            </div>
                        </v-server-table>
                    </div>
                </div>
            </div>
        </div>

         <!-- Modal -->
        <div class="modal" id="myModal">
            <div class="modal-dialog" style="max-width: 80%;">
                <div class="modal-content">
                    <!-- Encabezado del Modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Pdf contratos</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Cuerpo del Modal -->
                    <div class="modal-body">
                        <!-- Contenido de tu formulario -->
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <embed v-if="pdfURLAll" :src="pdfURLAll" type="application/pdf" width="100%" height="500" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie del Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal" id="ContratoEditModal">
            <div class="modal-dialog" style="max-width: 80%;">
                <div class="modal-content">
                    <!-- Encabezado del Modal -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Title</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Cuerpo del Modal -->
                    <div class="modal-body">
                        <!-- Contenido de tu formulario -->
                        <div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="elementTitle">Unidad Ejecutora:</label>
                                        <input type="text" class="form-control" id="ejecutor" v-model="ejecutor" />
                                    </div>

                                    <div class="form-group">
                                        <label for="elementDescription">Número de Correlativo:</label>
                                        <input type="text" class="form-control" id="num_id" v-model="num_id"/>
                                    </div>

                                    <div class="form-group">
                                        <h2>1. Datos del Proveedor:</h2>
                                        <label for="senor_es">Señor(es)</label>
                                        <input type="text" class="form-control" id="senor_es" v-model="proveedor.senor_es" />
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" v-model="proveedor.direccion" />
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="cci">CCI</label>
                                            <input type="number" class="form-control" id="cci" v-model="proveedor.cci" />
                                        </div>
                                        <div class="form-group col">
                                            <label for="ruc">RUC</label>
                                            <input type="number" class="form-control" id="ruc" v-model="proveedor.ruc" />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="number" class="form-control" id="telefono" v-model="proveedor.telefono" />
                                        </div>
                                        <div class="col form-group">
                                            <label for="fax">Fax</label>
                                            <input type="number" class="form-control" id="fax" v-model="proveedor.fax" />
                                        </div>
                                    </div>

                                    <!-- Sección Condiciones Generales -->
                                    <h2>2. Condiciones Generales</h2>
                                    <div class="form-row">
                                        <div class="col-5 form-group">
                                            <label for="cuadro_adquisicion">N° Cuadro Adquisición</label>
                                            <input type="text" class="form-control" id="cuadro_adquisicion" v-model="condiciones.cuadro_adquisicion" />
                                        </div>
                                        <div class="col form-group">
                                            <label for="tipo_proceso">Tipo de Proceso</label>
                                            <input type="text" class="form-control" id="tipo_proceso" v-model="condiciones.tipo_proceso" />
                                        </div>
                                        <div class="col-4 form-group">
                                            <label for="num_contrato">N° Contrato</label>
                                            <input type="text" class="form-control" id="num_contrato" v-model="condiciones.num_contrato" />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="moneda">Moneda</label>
                                            <input type="text" class="form-control" id="moneda" v-model="condiciones.moneda" />
                                        </div>
                                        <div class="col form-group">
                                            <label for="tipo_cambio">T/C</label>
                                            <input type="text" class="form-control" id="tipo_cambio" v-model="condiciones.tipo_cambio" />
                                        </div>
                                    </div>
                                </div>
                                <!-- <h2>Concepto General</h2> -->

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="concepto">Concepto General</label>
                                        <textarea type="text" class="form-control" id="concepto" v-model="condiciones.concepto"> </textarea>
                                    </div>
                                    <h2>3. Datos Adicionales</h2>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <label for="cuadro_adquisicion">Codigo</label>
                                            <input type="text" class="form-control" id="codigo" v-model="datos.codigo" />
                                        </div>
                                        <div class="col form-group">
                                            <label for="cuadro_adquisicion">Unidad de medida</label>
                                            <input type="text" class="form-control" id="medida" v-model="datos.medida" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="descripcion_general">Descripción General</label>
                                        <input type="text" class="form-control" id="descripcion_general" v-model="datos.descripcion_general" />
                                    </div>
                                    <!-- <div class="form-inline form-group">
                    <label for="cuadro_adquisicion" class="d-block">Descripción</label>
                    <input type="text" class="col form-control" id="descripciones" v-model="dato" />
                    <button class="col-auto btn btn-success" @click="addDesc">+</button>
                </div> -->

                                    <div class="form-group">
                                        <label for="elementDescription">Descripción:</label>
                                        <div class="input-group">
                                            <textarea class="form-control" id="descripciones" v-model="dato"></textarea>
                                            <button class="btn btn-success" @click="addDesc">
                                                <i class="fas fa-plus"></i>
                                                <!-- Icono de Font Awesome para el símbolo de más -->
                                            </button>
                                        </div>
                                    </div>

                                    <ul class="list-group flex-wrap">
                                        <li v-for="(item, index) in datos.descripciones" :key="item.id" class="list-group-item d-flex justify-content-between align-items-center mb-1">
                                            <div v-if="!editando || index !== indiceEditando">
                                                {{ item }}
                                            </div>
                                            <div v-else class="flex-grow-1">
                                                <!-- <input type="text-area" v-model="datos.descripciones[index]" class="form-control" @keyup.enter="guardarEdicion(index)" @blur="cancelarEdicion" /> -->
                                                <textarea
                                                    type="text-area"
                                                    v-model="datos.descripciones[index]"
                                                    class="form-control"
                                                    @keyup.enter="guardarEdicion(index)"
                                                    @blur="cancelarEdicion"
                                                ></textarea>
                                            </div>
                                            <div class="btn-group">
                                                <button @click="toggleEdicion(index)" class="btn btn-warning btn-sm">
                                                    <i v-if="!editando || index !== indiceEditando" class="fas fa-edit"></i>
                                                    <i v-else class="fas fa-check"></i>
                                                </button>
                                                <button @click="deletDesc(index)" class="ml-1 btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="form-group">
                                        <label for="cuadro_adquisicion">Monto</label>
                                        <input type="number" class="form-control" id="monto" v-model="datos.monto" />
                                    </div>
                                    <button class="btn btn-primary" @click="addElement">Agregar Elemento</button>
                                    <button class="btn btn-primary" @click="generatePDF">Generar PDF</button>
                                </div>
                            </div>
                           
                            <embed v-if="pdfURL" :src="pdfURL" type="application/pdf" width="100%" height="500" />
                        </div>
                    </div>
                    <pre>
                        {{ $data }}
                    </pre>
                    <!-- Pie del Modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import $ from "jquery";
import toastr from "toastr";
import "vue-select/dist/vue-select.css";

export default {
    data() {
        return {
            ejecutor: "UNIVERSIDAD NACIONAL DEL ALTIPLANO",
            num_id: "",
            dato: "",
            elements: [],
            pdfURL: null,
            pdfURLAll:null,
            proveedor: {
                senor_es: "",
                direccion: "",
                cci: "",
                ruc: "",
                telefono: "",
                fax: ""
            },
            condiciones: {
                cuadro_adquisicion: "",
                tipo_proceso: "",
                num_contrato: "",
                moneda: "SOLES",
                tipo_cambio: "",
                concepto: ""
            },
            datos: {
                codigo: "",
                medida: "",
                descripcion_general: "",
                descripciones: [],
                monto: ""
            },
            editando: false,
            indiceEditando: null,
            ///table//
            columns: [
                "id",
                "dni",
                "ruc",
                "cci",
                "num_os",
                "apellidos_nombres",
                "domicilio",
                "departamento",
                "provincia",
                "distrito",
                "celular",
                "cuadro_adq",
                "valor_total",
                "codigo",
                "pedido",
                "descripcion",
                "actions"
            ],
            options: {
                headings: {
                    id: "id",
                    dni: "Documento",
                    apellidos_nombres: "Nombres",
                    ruc: "RUC",
                    num_os: "N° O/S"
                },
                sortable: ["id", "dni", "apellidos_nombres"],
                filterable: ["dni", "apellidos_nombres", "num_os", "valor_total", "codigo", "pedido", "descripcion"],
                filterByColumn: true
            }
        };
    },
    methods: {
        addDesc() {
            if (this.dato.length && this.datos) {
                this.datos.descripciones.push(this.dato);
                this.dato = ""; // Limpiar la variable dato después de agregar
            }
        },
        editarDesc(index) {
            this.indiceEditando = index;
            this.editando = true;
        },
        guardarEdicion(index) {
            this.indiceEditando = null;
            this.editando = false;
        },

        cancelarEdicion() {
            this.indiceEditando = null;
            this.editando = false;
        },
        toggleEdicion(index) {
            if (this.editando && index === this.indiceEditando) {
                // Si ya estamos editando este elemento, guardamos la edición
                this.guardarEdicion(index);
            } else {
                // Si no estamos editando este elemento, iniciamos la edición
                this.editarDesc(index);
            }
        },
        deletDesc(index) {
            const confirmacion = window.confirm("¿Estás seguro de que deseas eliminar esta descripción?");
            if (confirmacion) {
                this.datos.descripciones.splice(index, 1);
            }
        },
        addElement() {
            if (this.ejecutor.trim() !== "") {
                this.elements.push({
                    codigo: this.datos.codigo,
                    medida: this.datos.medida,
                    descripcion_general: this.datos.descripcion_general,
                    descripciones: this.datos.descripciones,
                    monto: this.datos.monto
                });
                // this.elementTitle = "";
                // this.elementDescription = "";
            }
        },
        generatePDF() {
            // Convierte la lista de elementos a JSON
            // const elementsJSON = JSON.stringify(this.elements);
            $(".loader").show();
            axios
                .post(
                    "/intranet/contabilidad/solicitud/pdf",
                    {
                        // elements: this.elements
                        ...this.$data
                        // params: {
                        //     data: elementsJSON
                        // }
                    },
                    {
                        responseType: "blob"
                    }
                )
                .then(response => {
                    $(".loader").hide();
                    const blob = new Blob([response.data], { type: "application/pdf" });
                    this.pdfURL = URL.createObjectURL(blob);
                })
                .catch(error => {
                    $(".loader").hide();
                    console.error(error);
                });
        },
        GenerarAll(){
             $(".loader").show();
            axios
                .post(
                    "/intranet/contabilidad/solicitud/pdfAll",
                    {
  
                    },
                    {
                        responseType: "blob"
                    }
                )
                .then(response => {
                    $(".loader").hide();
                    $("#myModal").modal("show");
                    const blob = new Blob([response.data], { type: "application/pdf" });
                    this.pdfURLAll = URL.createObjectURL(blob);
                })
                .catch(error => {
                    $(".loader").hide();
                    console.error(error);
                });
        },
        truncateDescription(description, maxLength) {
            if (description.length > maxLength) {
                return description.substring(0, maxLength) + "...";
            }
            return description;
        },
        editarContrato(id) {
            this.elements = [];
            this.pdfURL = "";
            axios.get("contrato/" + id + "/edit").then(response => {
                console.log(response);
                this.num_id = response.data.num_os;
                this.proveedor.senor_es = response.data.apellidos_nombres;
                this.proveedor.direccion = response.data.domicilio;
                this.proveedor.cci = response.data.cci;
                this.proveedor.ruc = response.data.ruc;
                this.proveedor.telefono = response.data.celular;
         
                this.condiciones.cuadro_adquisicion = response.data.cuadro_adq;
                this.condiciones.tipo_proceso = response.data.tipo_proceso;
                this.condiciones.num_contrato = response.data.num_contrato;
                this.condiciones.moneda = response.data.moneda;
                //this.condiciones.tipo_cambio = response.data.celular;
                this.condiciones.concepto = response.data.referencia;

   
                this.datos.codigo =response.data.codigo;
                this.datos.medida =response.data.unidad_medida;
                this.datos.descripcion_general =response.data.descripcion_general;
                this.datos.descripciones = [response.data.descripcion];
                this.datos.monto = response.data.valor_total;

                this.elements.push(
                    {
                    codigo: this.datos.codigo,
                    medida: this.datos.medida,
                    descripcion_general: this.datos.descripcion_general,
                    descripciones: this.datos.descripciones,
                    monto: this.datos.monto
                    }
                );

            });
            $("#ContratoEditModal").modal("show");
        },
        eliminarContrato(id){
            const confirmacion = window.confirm("¿Estás seguro de que deseas eliminar esta Orden?");
            if (confirmacion) {
                //this.datos.descripciones.splice(index, 1);
                   $(".loader").show();
                    axios.delete("contrato/" + id )
                        .then(response => {
                            $(".loader").hide();
                            console.log(response);
                            this.$refs.table.refresh();
                            toastr.success("Se elimino correctamente", "Aviso");
                        })
                        .catch(error => {
                            $(".loader").hide();
                            console.error(error);
                        });

            }
        }
    }
};
</script>
