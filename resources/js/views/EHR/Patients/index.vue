<template>
    <section>
        <!--Formulario-->
        <bacab-aside  :name="bacabAsideText" v-if="asideOpenClose === true">
            <template slot="buttons">
                <el-button
                        size="mini"
                        icon="fas fa-save"
                        round>
                    Save
                </el-button>
            </template>
            <template slot="content">
                <div class="box">
                    <div class="box__header">
                        <h3 class="box__title">{{ bacabAsideText }}</h3>
                    </div>
                    <div class="box__body box--box-aside-hight">
                        <el-tabs type="border-card">
                            <el-tab-pane>
                                <span slot="label"><i class="el-icon-info"></i> Información Básica</span>
                                <el-form ref="patientForm"
                                         size="mini"
                                         status-icon
                                         :model="form"
                                         :rules="rules"
                                         label-width="120px">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <el-form-item label="Nombre" prop="name">
                                                <el-input
                                                        v-model="form.name"
                                                        type="text"
                                                        placeholder="Escribe el nombre del paciente"
                                                        suffix-icon="el-icon-edit">
                                                </el-input>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <el-form-item label="Apellido Paterno" prop="last_name">
                                                <el-input
                                                        v-model="form.last_name"
                                                        type="text"
                                                        placeholder="Escribe el nombre del paciente"
                                                        suffix-icon="el-icon-edit">
                                                </el-input>
                                            </el-form-item>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <el-form-item label="Apellido Materno" prop="mother_last_name">
                                                <el-input
                                                        v-model="form.mother_last_name"
                                                        type="text"
                                                        placeholder="Escribe el nombre del paciente"
                                                        suffix-icon="el-icon-edit">
                                                </el-input>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12, col-sm-6 col-md-6 col-lg-6">
                                            <el-form-item label="Sexo" prop="gender">
                                                <el-select v-model="form.gender" placeholder="Seleciona el sexo">
                                                    <el-option
                                                            v-for="item in tableConfig[1].header.filter.options"
                                                            :key="item.value"
                                                            :label="item.label"
                                                            :value="item.value">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <el-form-item label="Fecha de nacimiento" prop="birthday">
                                                <div class="block">
                                                    <el-date-picker
                                                            v-model="form.birthday"
                                                            type="date"
                                                            prefix-icon="el-icon-date"
                                                            placeholder="Toma un día">
                                                    </el-date-picker>
                                                </div>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12, col-sm-6 col-md-6 col-lg-6">
                                            <el-form-item label="Tipo de sangre" prop="blood_group">
                                                <el-select v-model="form.blood_group" placeholder="Selecciona el tipo de sangre">
                                                    <el-option
                                                            v-for="item in tableConfig[3].header.filter.options"
                                                            :key="item.value"
                                                            :label="item.label"
                                                            :value="item.value">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </div>
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                            <el-form-item label="Estado civil">
                                                <el-select v-model="form.marital_status" placeholder="Selecciona un estado civil">
                                                    <el-option
                                                            v-for="item in maritalStatus"
                                                            :key="item.value"
                                                            :label="item.label"
                                                            :value="item.value">
                                                    </el-option>
                                                </el-select>
                                            </el-form-item>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <el-form-item label="Alergías">
                                                <el-input v-model="form.allergies"
                                                          type="textarea"
                                                          :rows="3"
                                                          placeholder="Alergías del paciente"
                                                          suffix-icon="el-icon-edit">

                                                </el-input>
                                            </el-form-item>
                                        </div>
                                    </div>
                                </el-form>
                            </el-tab-pane>
                        </el-tabs>

                    </div>
                </div>
            </template>
        </bacab-aside>



        <div class="header-buttons">
            <div class="header-buttons__main-buttons">
                <el-button
                    size="small"
                    round
                    @click="openAside"
                    icon="glyphicon glyphicon-floppy-open">
                    <b>Ingresar Paciente</b>
                </el-button>
            </div>
        </div>

        <div class="main-panel">
            <bacab-tables title="Listado de Pacientes" remote-url="/ehr/patients/index/" :table-config="tableConfig">
                <template slot="actions">
                    <div style="rigth: 0">
                        <el-button
                                size="small"
                                round
                                type="info"
                                @click="test()"
                                icon="fas fa-edit">
                            <b>Editar</b>
                        </el-button>
                        <el-button
                                size="small"
                                round
                                type="danger"
                                @click="test()"
                                icon="fas fa-trash-alt">
                            <b>Borrar</b>
                        </el-button>
                    </div>
                </template>
            </bacab-tables>
        </div>

    </section>
</template>

<script>
    import BacabTables from "../../../ui/components/bacabTables";
    import BacabAside from "../../../ui/components/bacabAside";
    import aside from "../../../ui/global/mixins/aside";
    export default {
        name: "index",
        mixins: [ aside ],
        components: { BacabAside, BacabTables},
        data() {
            return {
                form: {
                    name: '',
                    last_name: '',
                    mother_last_name: '',
                    gender: '',
                    birthday: '',
                    blood_group: '',
                    marital_status: '',
                    allergies: '',
                },
                rules: {
                    name: [
                        { required: true, message: 'El nombre es requerido', trigger: 'blur' },
                    ],
                    last_name: [
                        { required: true, message: 'El nombre es requerido', trigger: 'blur' },
                    ],
                    mother_last_name: [
                        { required: true, message: 'El apellido es requerido', trigger: 'blur' },
                    ],
                    gender: [
                        { required: true, message: 'Es requerido saber el sexo del paciente', trigger: 'change' }
                    ],
                    blood_group: [
                        { required: true, message: 'Se requiere el tipo de sangre para continuar',trigger: 'change' }
                    ],
//                birthday: [
//                    { type: 'date', required: true, message: 'Por favor ingrese la fecha de nacimiento del paciente', trigger: 'change' }
//                ]
                },
                labelPosition: 'top',

                maritalStatus: [
                    {
                        value: 'Soltero',
                        label: 'Soltero'
                    },
                    {
                        value: 'Casado',
                        label: 'Casado'
                    },
                    {
                        value: 'Separado',
                        label: 'Separado'
                    },
                    {
                        value: 'Divorciado',
                        label: 'Divorciado'
                    },


                ],

                bacabAsideText: 'Nuevo Paciente',
                modalOpen: false,
                tableConfig: [
                    {
                        header: {
                            name: 'Nombre',
                            prop: 'fullname',
                            width: '350px',
                            filter: {
                                type: 'input'
                            }
                        },


                    },
                    {
                        header: {
                            name: 'Sexo',
                            prop: 'gender',
                            width: '200px',
                            filter: {
                                type: 'select',
                                options: [
                                    {
                                        value: 0,
                                        label: 'Hombre',
                                    },
                                    {
                                        value: 1,
                                        label: 'Mujer',
                                    },
                                    {
                                        value: 2,
                                        label: 'Otro',
                                    },

                                ]
                            }
                        }
                    },
                    {
                        header: {
                            name: 'Edad',
                            prop: 'birthday',
                            width: '300px',
                            filter: {
                                type: 'input'
                            }
                        }
                    },
                    {
                        header: {
                            name: 'Grupo sanguíneo',
                            prop: 'blood_group',
                            width: '200px',
                            filter: {
                                type: 'select',
                                options: [
                                    {
                                        value: 'O-',
                                        label: 'O-',
                                    },
                                    {
                                        value: 'O+',
                                        label: 'O+',
                                    },
                                    {
                                        value: 'A−',
                                        label: 'A−',
                                    },
                                    {
                                        value: 'A+',
                                        label: 'A+',
                                    },
                                    {
                                        value: 'B-',
                                        label: 'B-',
                                    },
                                    {
                                        value: 'B+',
                                        label: 'B+',
                                    },
                                    {
                                        value: 'AB',
                                        label: 'AB-',
                                    },
                                    {
                                        value: 'AB+',
                                        label: 'AB+',
                                    },


                                ]
                            }
                        }
                    },
                    {
                        header: {
                            name: 'Acciones',
                            width: '200px',
                        },
                        body:{
                            type: 'slot',
                            slot: 'actions'
                        }
                    }
                ]
            }
        },
        methods: {
            openModal(){
                this.modalOpen ?
                    this.modalOpen = false :
                    this.modalOpen = true;

            },
            test(){
                console.log('simon ese')
            }
        }
    }
</script>

<style scoped>

</style>