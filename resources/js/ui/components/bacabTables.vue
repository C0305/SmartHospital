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
                <template v-for="(header,index) in tableConfig[1]">
                    <el-table-column
                            v-if="header.filter !== null"
                            :key="index"
                            :label="header.name"
                            :prop="header.prop"
                            :width="header.width"
                            :fixed="header.fixed">
                        <template slot="header" slot-scope="scope">
                            <div class="bacab-table__header-container" style="display: grid">
                                <label class="bacab-table__header-container__item">{{ header.name }}</label>

                                <el-input style="width: 100%"
                                          v-if="header.filter.type === 'input'"
                                          v-model="search"
                                          class="bacab-table__header-container__item"
                                          size="mini"
                                          placeholder="Type to search"/>
                                <el-date-picker
                                        style="width: 100%"
                                        v-if="header.filter.type === 'date'"
                                        v-model="value6"
                                        type="daterange"
                                        size="mini"
                                        range-separator="To"
                                        start-placeholder="Start date"
                                        end-placeholder="End date">
                                </el-date-picker>
                                <el-select
                                        v-if="header.filter.type === 'select'"
                                        multiple
                                        placeholder="Select">
                                    <el-option
                                            v-for="item in header.filter.selectOptions"
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
                            :label="header.name"
                            :prop="header.prop"
                            :width="header.width"
                            :fixed="header.fixed">

                        <template slot="header" slot-scope="scope">
                            <div class="bacab-table__header-container" style="display: grid">
                                <label class="bacab-table__header-container__item">{{ header.name }}</label>
                            </div>
                        </template>
                    </el-table-column>
                </template>

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