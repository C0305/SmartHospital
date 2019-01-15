<template>
    <div>
        <bacab-aside :close-function="closeNewGoal" :name="bacabAsideText" v-if="newElementAside === true">
            <template slot="content">
                <div class="box">
                    <div class="box__header">
                        <h3 class="box__title">{{ bacabAsideText }}</h3>
                    </div>
                    <div class="box__body">
                        <el-form ref="form" :model="goal" label-width="120px">
                            <el-form-item label="Title">
                                <el-input v-model="goal.title">
                                </el-input>
                            </el-form-item>
                            <el-form-item label="Description">
                                <el-input type="textarea"
                                          v-model="goal.description">
                                </el-input>
                            </el-form-item>
                            <el-form-item label="Notes">
                                <el-input type="textarea"
                                          v-model="goal.notes">
                                </el-input>
                            </el-form-item>
                            <el-form-item label="Period">
                                <el-col :span="7">
                                    <el-date-picker type="date"
                                                    placeholder="Start Date"
                                                    v-model="goal.start_date">
                                    </el-date-picker>
                                </el-col>
                                <el-col class="line" :span="1">-</el-col>
                                <el-col :span="7">
                                    <el-date-picker
                                            type="date"
                                            placeholder="End Date"
                                            v-model="goal.end_date">
                                    </el-date-picker>
                                </el-col>
                            </el-form-item>
                            <el-form-item label="Progress">
                                <el-slider
                                        style="margin-right: 10px"
                                        v-model="goal.progress"
                                        :step="1">
                                </el-slider>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
            </template>
            <template slot="buttons">
                <el-button
                        size="mini"
                        icon="fas fa-save"
                        @click="save"
                        round>
                    Save
                </el-button>
            </template>
        </bacab-aside>

        <div class="main-panel">
            <div class="main__cards">
                <div class="card">
                    <div class="card__header">
                        <div class="card__header-title text-light">Your <strong>Goals</strong>
                        </div>
                        <div style="margin-right: 10px"class="header-buttons__secondary-buttons">
                            <el-button round
                                       @click="newGoal"
                                       size="mini"
                                       type="primary"
                                       icon="fas fa-plus-circle">
                                New Goal
                            </el-button>
                        </div>
                    </div>
                    <div v-if="goalsArray.length !== 0" class="card__main card__main__main-panel">
                        <div  v-for="goal in goalsArray" @click="showGoal(goal)" class="card__row">
                            <div class="card__icon"><i class="fas fa-calendar-check"></i></div>
                            <div class="card__time">
                                <div>{{ showDate(goal.startDate) }} - {{ showDate(goal.endDate) }} </div>
                            </div>
                            <div class="card__detail">
                                <div class="card__source text-bold">{{ goal.title }}</div>
                                <div class="card__description">{{ goal.description }}</div>
                                <div class="card__note">{{ goal.note }}</div>
                                <el-progress
                                        :text-inside="true"
                                        :stroke-width="18"
                                        :percentage="goal.progress"
                                        :status="goalStatus(goal)">
                                </el-progress>
                            </div>
                        </div>
                    </div>
                </div>
                <div  class="card">
                    <div class="card__header">
                        <div v-if="goal.title !== ''" class="card__header-title text-light"> <strong>{{ goal.title }}</strong>
                        </div>
                        <div v-else class="card__header-title text-light">Click on the goal to edit.
                        </div>
                        <div style="margin-right: 10px" v-if="goal.title !== ''" class="header-buttons__secondary-buttons">
                            <el-button round
                                       @click="editGoal(goal)"
                                       size="mini"
                                       type="primary"
                                       icon="fas fa-edit">
                                Edit
                            </el-button>
                            <el-button round
                                       @click="deleteGoal(goal)"
                                       size="mini"
                                       type="danger"
                                       icon="fas fa-trash-alt">
                                Delete
                            </el-button>
                        </div>
                    </div>
                    <div v-if="goal.title !== ''"  class="card__main card__main__main-panel">
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-pencil-alt"></i></div>
                            <div class="card__time">
                                <div>Title</div>
                            </div>
                            <div class="card__detail">
                                <el-input disabled placeholder="Title" v-model="goal.title"></el-input>
                            </div>
                        </div>
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-pencil-alt"></i></div>
                            <div class="card__time">
                                <div>Description</div>
                            </div>
                            <div class="card__detail">
                                <el-input
                                        type="textarea"
                                        autosize
                                        disabled
                                        placeholder="Description"
                                        v-model="goal.description">
                                </el-input>
                            </div>
                        </div>
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-pencil-alt"></i></div>
                            <div class="card__time">
                                <div>Notes</div>
                            </div>
                            <div class="card__detail">
                                <el-input
                                        disabled
                                        v-model="goal.note"
                                        placeholder="Notes">
                                </el-input>
                            </div>
                        </div>
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-calendar"></i></div>
                            <div class="card__time">
                                <div>Start Date</div>
                            </div>
                            <div class="card__detail">
                                <div class="block">
                                    <el-date-picker
                                            type="date"
                                            v-model="goal.start_date"
                                            readonly
                                            placeholder="Start Date">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-calendar"></i></div>
                            <div class="card__time">
                                <div>End Date</div>
                            </div>
                            <div class="card__detail">
                                <div class="block">
                                    <el-date-picker
                                            type="date"
                                            readonly
                                            v-model="goal.end_date"
                                            placeholder="End Date">
                                    </el-date-picker>
                                </div>
                            </div>
                        </div>
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-tasks"></i></div>
                            <div class="card__time">
                                <div>Progress</div>
                            </div>
                            <div class="card__detail">
                                <div class="block">
                                    <div class="block">
                                        <el-progress
                                                :text-inside="true"
                                                :stroke-width="18"
                                                :percentage="goal.progress"
                                                :status="goalStatus(goal)">
                                        </el-progress>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card__row">
                            <div class="card__icon"><i class="fas fa-project-diagram"></i></div>
                            <div class="card__time">
                                <div>Projects</div>
                            </div>
                            <div class="card__detail">
                                <el-tag>SmartHospital</el-tag>
                            </div>
                        </div>
                    </div>

                </div>
            </div> <!-- /.main-cards -->
        </div>
    </div>
</template>

<script>
    import Layout from '../../ui/global/mixins/Layout';
    import BacabAside from "../../ui/components/bacabAside";
    import moment from 'moment'
    export default {
        name: "goals",
        components: {BacabAside},
        mixins: [Layout],
        data() {
            return {
                bacabAsideText: "",
                newElementAside: false,
                goalsArray: [],
                goal: {
                    id: 'nc17',
                    title: '',
                    description: '',
                    note: '',
                    start_date: '',
                    end_date: '',
                    progress: 0,
                }
            }
        },
        mounted(){
            this.init();
        },
        methods:{
            init(){
                axios.get('/goals/show/').then((response)=>{
                    let data =  response.data;
                    for(let i = 0; i < data.length; i++){
                        data[i].start_date = Date(data[i].start_date);
                        data[i].end_date = Date(data[i].end_date);
                    }
                    this.goalsArray = data
                });
            },
            showDate(v) {
                return moment(v).format('YYYY-MM-DD');
            },
            goalStatus(goal){
                if(goal.progress < 50) {
                    return 'exception';
                }
            },
            showGoal(goal){
                this.goal = goal;
            },
            editGoal(){
                this.newElementAside = true;
                this.bacabAsideText = 'New Goal'
            },
            save(){
                let data = this.goal;
                data.start_date = moment(data.start_date).format('YYYY-MM-DD HH:mm:ss');
                data.end_date = moment(data.end_date).format('YYYY-MM-DD HH:mm:ss');
                axios.post('/goals', data).then( response => {
                    this.$message({
                        message: 'Successful operation.',
                        type: 'success'
                    });
                    this.init();
                    this.closeNewGoal();
                }).catch(() => {
                    this.$message.error('Can not save the data.');
                });
            },
            deleteGoal(goal){
                this.$confirm('This will permanently delete the goal. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    axios.delete('/goals/'+goal.id).then( response => {
                        this.$message({
                            message: 'Successful operation.',
                            type: 'success'
                        });
                        this.init();
                        this.goal = {
                            title: '',
                            description: '',
                            note: '',
                            start_date: '',
                            end_date: '',
                            progress: 0,
                        }
                    }).catch(() => {
                        this.$message.error('Can not save the data.');
                    });
                }).catch(() => {
                    this.$message({
                        type: 'info',
                        message: 'Delete canceled'
                    });
                });

            },
            newGoal(){
                this.newElementAside = true;
                this.bacabAsideText = 'New Goal'
                this.goal = {
                    title: '',
                    description: '',
                    notes: '',
                    start_date: '',
                    end_date: '',
                    progress: 0,
                }
            },
            closeNewGoal(value){
                this.newElementAside = false;
            },
            saveNewGoal() {
                //throw new Error("Whoops!");
            }
        }
    }

</script>

