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
                    <bacab-tables :data-array="dataArray" :table-config="tableConfig">
                        <template slot="acciones">
                            asdasdasd
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
                                prop: 'name',
                                filter: {
                                    type: 'date'
                                }
                            }
                        },
                        {
                            header: {
                                name: 'Edad',
                                prop: 'age',
                                filter: {
                                    type: 'input'
                                }
                            }
                        },
                        {
                            header: {
                                name: 'Sexo',
                                prop: 'sex',
                                filter: {
                                    type: 'input'
                                }
                            }
                        }
                    ]
                ],
                dataArray: [
                    {
                        id: 1,
                        name: 'Bob Patiño',
                        age: 6,

                    },
                    {
                        id: 1,
                        name: 'Bob Patiño',
                        age: 6
                    },
                    {
                        id: 1,
                        name: 'Bob Patiño',
                        age: 6
                    }
                ]
            }
        },
        components: {BacabTables}
    }
</script>

<style scoped>

</style>