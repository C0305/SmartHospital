<template>
    <div class="box">
        <div class="box__header">

        </div>
        <div class="box__body">
            <el-table
                    :data="dataArray"
                    highlight-current-row
                    border>
                <el-table-column
                        fixed
                        type="index"
                        width="50"/>
                <template v-for="(column,index) in tableConfig[1]">
                    <el-table-column
                            v-if="column.header.filter !== null"
                            :key="index"
                            :label="column.header.name"
                            :prop="column.header.prop"
                            :width="column.header.width"
                            :fixed="column.header.fixed">
                        <template slot="header" slot-scope="scope">
                            <div class="bacab-table__header-container" style="display: grid">
                                <label class="bacab-table__header-container__item">{{ column.header.name }}</label>

                                <el-input style="width: 100%"
                                          v-if="column.header.filter.type === 'input'"
                                          v-model="filters[column.header.prop]"
                                          class="bacab-table__header-container__item"
                                          size="mini"
                                          placeholder="Type to search"/>

                                <el-date-picker
                                        style="width: 100%"
                                        v-if="column.header.filter.type === 'date'"
                                        v-model="filters[column.header.prop]"
                                        type="daterange"
                                        size="mini"
                                        range-separator="To"
                                        start-placeholder="Start date"
                                        end-placeholder="End date">
                                </el-date-picker>
                                <el-select
                                        style="width: 100%"
                                        v-if="column.header.filter.type === 'select'"
                                        multiple
                                        v-model="filters[column.header.prop]"
                                        placeholder="Select">
                                    <el-option
                                            v-for="item in column.header.filter.selectOptions"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                    </el-option>
                                </el-select>
                            </div>
                        </template>
                    </el-table-column>
                    <el-table-column
                            v-else
                            :key="index"
                            :label="column.header.name"
                            :prop="column.header.prop"
                            :width="column.header.width"
                            :fixed="column.header.fixed">

                        <template slot="header" slot-scope="scope">
                            <div class="bacab-table__header-container" style="display: grid">
                                <label class="bacab-table__header-container__item">{{ column.header.name }}</label>
                            </div>
                        </template>
                        <template v-if="column.slot !== null">
                            <template slot-scope="scope">
                                <slot :name="column.slot"/>
                            </template>
                        </template>

                    </el-table-column>
                </template>

            </el-table>
        </div>
    </div>
</template>

<script>
    import cloneDeep from 'lodash'
    export default {
        props: {
            tableConfig: Array,
            dataArray: Array,
            remoteSearch: Function
        },
        data(){
            return {
                filters: {}
            }
        },
        created(){
            this.setFilters();
        },
        watch:{
            filters: {
                handler(newValue) {
                    console.log(this.filters);
                },
                deep: true
            }
        },
        methods: {
            setFilters(){
                this.tableConfig[1].forEach( item => {
                   if(item.header.filters !== null){
                       if(item.header.prop !== null || typeof item.header.prop !== undefined){
                           this.$set(this.filters, item.header.prop, null );
                       }
                   }
                })
                console.log(this.filters);
            },
            sendToRemoteSearch(){
                let filters = cloneDeep(this.filters);
                console.log(filters);
                this.remoteSearch(filters);
            }
        },
        name: "bacabTables"
    }
</script>

<style scoped>

</style>