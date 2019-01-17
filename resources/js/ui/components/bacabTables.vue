<template>
    <div class="box">
        <div class="box__header">

        </div>
        <div class="box__body">
            <el-table
                    :data="dataArray"
                    border>
                <el-table-column
                        type="index"
                        width="50"/>
                <el-table-column>
                </el-table-column>
                <el-table-column
                        v-for="(header,index) in tableConfig[1]"
                        :key="index"
                        :label="header.name"
                        :prop="header.prop"
                        :width="header.width"
                        :fixed="header.fixed">
                    <slot :name="tableConfig[0].accionesSlot"></slot>
                </el-table-column>
                <el-table-column
                        v-if="tableConfig[0].acciones === true"
                        label="Acciones">
                    <slot :name="tableConfig[0].accionesSlot"></slot>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            tableConfig: Array,
            dataArray: Array,
        },
        name: "bacabTables"
    }
</script>

<style scoped>

</style>