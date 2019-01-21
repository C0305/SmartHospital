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
                    <div class="box__body">
                        <el-form ref="patientForm" :model="form">
                            <el-form-item label="Activity name">
                                <el-input ></el-input>
                            </el-form-item>
                        </el-form>
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
                    name: ''
                },
                bacabAsideText: 'Nuevo Paciente',
                modalOpen: false,
                tableConfig: [
                    {
                        acciones: true,
                        accionesSlot: "acciones"
                    },
                    [
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
                ],
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