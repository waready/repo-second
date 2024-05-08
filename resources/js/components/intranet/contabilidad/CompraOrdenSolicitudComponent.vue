<template>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Abrir Modal
        </button>

        <!-- Modal -->
        <div class="modal" id="myModal">
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

                                    <!-- <div class="form-group">
                    <label for="elementDescription">Número de Identificacion:</label>
                    <textarea type="text" class="form-control" id="num_id" v-model="num_id"> </textarea>
                </div> -->

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
                                        <input type="text" class="form-control" id="monto" v-model="datos.monto" />
                                    </div>
                                    <button class="btn btn-primary" @click="addElement">Agregar Elemento</button>
                                    <button class="btn btn-primary" @click="generatePDF">Generar PDF</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <ul>
                                        <li v-for="(element, index) in elements" :key="index">
                                            <strong>{{ element.ejecutor }}:</strong> {{ element.num_id }}
                                        </li>
                                    </ul>
                                    {{ datos.monto }}
                                </div>
                            </div>
                            <embed v-if="pdfURL" :src="pdfURL" type="application/pdf" width="100%" height="500" />
                            <pre>{{ $data }}</pre>
                        </div>
                    </div>

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
export default {
    data() {
        return {
            ejecutor: "UNIVERSIDAD NACIONAL DEL ALTIPLANO",
            num_id: "",
            dato: "",
            elements: [],
            pdfURL: null,

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
            indiceEditando: null
        };
    },
    methods: {
        addDesc(id) {
            if (this.dato.length) {
                this.datos.descripciones.push(this.dato);
                this.dato = "";
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
                    ejecutor: this.ejecutor,
                    num_id: this.num_id,
                    senor_es: this.proveedor.senor_es,
                    direccion: this.proveedor.direccion,
                    cci: this.proveedor.cci,
                    ruc: this.proveedor.ruc,
                    telefono: this.proveedor.telefono,
                    fax: this.proveedor.fax,
                    cuadro_adquisicion: this.condiciones.cuadro_adquisicion,
                    tipo_proceso: this.condiciones.tipo_proceso,
                    num_contrato: this.condiciones.num_contrato,
                    moneda: this.condiciones.moneda,
                    tipo_cambio: this.condiciones.tipo_cambio,
                    concepto: this.concepto_general,
                    codigo: this.datos.codigo,
                    medida: this.datos.medida,
                    descripcion_general: this.datos.descripcion_general,
                    descripciones: JSON.parse(JSON.stringify(this.datos.descripciones)),
                    monto: this.datos.monto
                });
                // this.elementTitle = "";
                // this.elementDescription = "";
            }
        },
        generatePDF() {
            // Convierte la lista de elementos a JSON
            // const elementsJSON = JSON.stringify(this.elements);

            axios
                .post(
                    "/intranet/contabilidad/compra/pdf",
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
                    const blob = new Blob([response.data], { type: "application/pdf" });
                    this.pdfURL = URL.createObjectURL(blob);
                })
                .catch(error => {
                    console.error(error);
                });
        }
    }
};
</script>
