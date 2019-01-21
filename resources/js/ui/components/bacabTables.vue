<template>
    <div class="box box--no-shadow ">
        <div class="box__header">
            <!--paginator-->
            <div class="header-buttons__secondary-buttons">
                <el-pagination
                        @size-change="queryMethod()"
                        @current-change="queryMethod()"
                        current-page.sync="currentPage"
                        :page-sizes="pageSizes"
                        :page-size="filters.pageSize"
                        layout="total, sizes, prev, pager, next, jumper"
                        :total="totalRecords">
                </el-pagination>
            </div>
        </div>
        <div class="box__body">
            <el-table
                    :data="dataArray"
                    v-loading="loadingData"
                    highlight-current-row
                    :max-height="tableHeight"
                    border>

                <!--Index-->

                <el-table-column
                        type="index"
                        :index="indexFunction"
                        width="50"/>

                <template v-for="(column,index) in tableConfig[1]">

                    <!--Columnas Con Filtro-->

                    <el-table-column
                            v-if="column.header.filter != null"
                            :key="index"
                            :label="column.header.name"
                            :prop="column.header.prop"
                            :width="column.header.width ? column.header.width : auto"
                            :fixed="column.header.fixed">
                        <template slot="header" slot-scope="props">
                            <div class="bacab-table__header-container" style="display: grid">
                                <!--Header-->
                                <label class="bacab-table__header-container__item">{{ column.header.name }}</label>


                                <!--Filtros-->

                                    <!--Input-->
                                <el-input style="width: 100%"
                                          v-if="column.header.filter.type === 'input'"
                                          v-model.lazy="filters[column.header.prop]"
                                          @keyup.enter.native="queryMethod()"
                                          class="bacab-table__header-container__item"
                                          size="mini"
                                          placeholder="Enter para buscar"/>

                                <!--Date Range-->

                                <el-date-picker
                                        style="width: 100%"
                                        class="bacab-table__header-container__item"
                                        v-if="column.header.filter.type === 'date'"
                                        v-model.lazy="filters[column.header.prop]"
                                        type="daterange"
                                        :change="queryMethod()"
                                        size="mini"
                                        range-separator="To"
                                        start-placeholder="Start date"
                                        end-placeholder="End date"/>

                                <!--Select Multiple-->

                                <template v-if="column.header.filter.type === 'select'">
                                    <el-select
                                            style="width: 100%"
                                            class="bacab-table__header-container__item"
                                            multiple
                                            :change="queryMethod()"
                                            size="mini"
                                            v-model="filters[column.header.prop]"
                                            placeholder="Select">
                                            <el-option
                                                    v-if="column.header.filter.options != null"
                                                    v-for="(item, index) in column.header.filter.options"
                                                    :key="index"
                                                    :label="item.label"
                                                    :value="item.value">
                                            </el-option>
                                    </el-select>
                                </template>

                                <slot v-if="column.header.filter.type === 'slot'" v-bind="props" :name="column.header.filter.slot" />
                            </div>
                        </template>

                        <!--Body Slot-->

                        <template slot-scope="props" v-if="column.body != null && column.body.slot != null && column.body.type === 'slot'">
                                <slot v-bind="props" :name="column.body.slot "></slot>
                        </template>
                    </el-table-column>

                    <!--Columnas sin filtro-->

                    <el-table-column
                            v-else
                            :key="index"
                            :label="column.header.name"
                            :prop="column.header.prop"
                            :width="column.header.width"
                            :fixed="column.header.fixed">

                        <!--Header Slot-->
                        <template slot="header" slot-scope="scope">
                            <div class="bacab-table__header-container" style="display: grid">
                                <label class="bacab-table__header-container__item">{{ column.header.name }}</label>
                            </div>
                        </template>

                        <!--Body Slot-->

                        <template slot-scope="props" v-if="column.body != null && column.body.slot != null && column.body.type === 'slot'">
                            <slot v-bind="props" :name="column.body.slot "></slot>
                        </template>

                    </el-table-column>
                </template>

            </el-table>
        </div>
    </div>
</template>

<script>
    import { cloneDeep } from 'lodash';
    import qs from 'qs';
    export default {
        props: {
            tableConfig: Array,
            remoteUrl: String,
            dataManipulationMethod: Function
        },
        data(){
            return {
                tableHeight: 0,
                error: null,
                lastSearch: 0,
                filters: {
                    pageSize: 25,
                },
                dataArray: [
                    {
                        name: 'sisi'
                    }
                ],
                currentPage: 1,
                pageSizes: [25, 50, 75, 100],
                totalRecords: null,
                from: 1,
                loadingData: false
            }
        },
        created(){
            this.setFilters();
            this.setHeight();
        },
        mounted(){
            this.queryMethod();
        },
        /*errorCaptured (err, vm, info) {
            this.error = `${err.stack}\n\nfound in ${info} of component`
            return false
        },*/
        methods: {
            setHeight(){
                this.tableHeight =  ($(window).height())-290;
            },
            indexFunction(index){
                return index * this.from;
            },
            setFilters(){
                this.tableConfig[1].forEach( item => {
                   if(item.header.filters !== null){
                       if(item.header.prop !== null || typeof item.header.prop !== undefined){
                           this.$set(this.filters, item.header.prop, null );
                       }
                   }
                });
            },
            queryMethod() {
                let now = new Date();
                if (now - this.lastSearch > 900) {
                    this.lastSearch = now;
                    let filters = cloneDeep(this.filters);
                    filters = qs.stringify(filters);
                    let url = this.remoteUrl + '?page=' + this.currentPage;
                    axios.get(url + '&' + filters).then((response) => {
                        if (this.dataManipulationMethod) {
                            this.from = response.data.from;
                            this.totalRecords = response.data.total;
                            this.dataArray = this.dataManipulationMethod(response.data.data);
                        } else {
                            this.from = response.data.from;
                            this.totalRecords = response.data.total;
                            this.dataArray = response.data.data;
                        }
                    }).catch(response => {
                        this.$message.error('Error al cargar los datos');
                        console.error('ERROR ' + response);
                    });
                }
            }
        },
        name: "bacabTables"
    }
</script>
