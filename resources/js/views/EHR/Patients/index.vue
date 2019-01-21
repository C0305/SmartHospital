<template>
    <section>
        <div class="header-buttons">
            <div class="header-buttons__main-buttons">
                <el-button
                    size="small"
                    round
                    icon="glyphicon glyphicon-floppy-open">
                    <b>Ingresar Paciente</b>
                </el-button>
            </div>
        </div>

        <div class="main-panel">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box__title">Listado de pacientes</h3>
                </div>
                <div class="box-body">
                    <bacab-tables remote-url="/ehr/patients/index/" :table-config="tableConfig">
                        <template slot="sexheader">
                            asdasdasd
                        </template>
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
            </div>
        </div>

    </section>
</template>

<script>
    import BacabTables from "../../../ui/components/bacabTables";
    export default {
        name: "index",
        components: {BacabTables},
        data() {
            return {
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
                                    type: 'slot',
                                    slot: 'sexheader',
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
            test(){
                console.log('simon ese')
            }
        }
    }
</script>

<style scoped>

</style>