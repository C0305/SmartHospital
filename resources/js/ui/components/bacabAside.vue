<template>
    <transition name="fade">
        <div class="lateral-aside">
            <div class="lateral-aside__top-bar">
                <span type="button" class="fas fa-times-circle" @click="close"></span>
                <p>{{ name }}</p>
            </div>
            <div class="lateral-aside_content">
                <div class="lateral-aside_content-panel">
                    <div class="lateral-aside_content-panel-body">
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>
            <div class="lateral-aside__bottom-bar">
                <template v-if="saveButton === false">
                    <slot name="buttons"></slot>
                </template>
                <template v-else-if="saveButton === true" >
                    <el-button size="mini" icon="fas fa-save" @click="saveAndClose" round>
                        Save
                    </el-button>
                </template>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        name: "bacabAside",
        props: {
            saveButton: Boolean,
            saveButtonFunction: Function,
            name: String,
            closeFunction: Function,
        },
        created(){
            this.$store.dispatch('general/bacabAsideOpenClose', true)
        },
        mounted(){
            document.body.insertBefore(this.$el, document.body.firstChild)
        },
        methods: {
            close() {
                this.$confirm('You are going to close the aside. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    this.closeFunction();
                    this.$store.dispatch('general/bacabAsideOpenClose',false)
                });

            },
            saveAndClose(){
                try{
                    this.saveButtonFunction();
                    this.closeFunction();
                    this.$store.dispatch('general/bacabAsideOpenClose',false)
                } catch (Exception) {
                    console.log('Error')
                    console.log(Exception)
                    this.$message.error('Ocurrio un error en el formulario: '+this.name);
                }

            }
        }
    }
</script>

<style scoped>
    .fade-enter-active {
        animation: slide-in .5s;
    }

    .fade-leave-active {
        animation: slide-in .5s reverse;
    }
    .fade-leave-to {
        opacity: 0;
    }

    @keyframes slide-in {
        from {
            margin-left: 100%;
            width: 0%;
        }

        to {
            margin-left: 30%;
            width: 70%;
        }
    }

    .lateral-aside {
        right: 0;
        position: fixed;
        height: calc(100% - 34px);
        background-color: #e0e3eb;
        color: #FFF;
        width: 70%;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.35), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
        z-index: 10;
    }
    .lateral-aside__top-bar {
        height: 27px;
        background-color: #394263;
        color: #F9FAFC;
        width: 100%;
        position: fixed;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
    }

    .lateral-aside__top-bar span {
        float: left;
        margin: 5px 5px;
    }

    .lateral-aside__top-bar span:active {
        color: #a4a7af;
    }

    .lateral-aside__top-bar p {
        display: inline-block;
        margin: 5px 5px;
    }

    .lateral-aside__bottom-bar {
        padding-top: 5px;
        padding-left: 5px;
        padding-bottom: 5px;
        height: 30px;
        background-color: transparent;
        color: #F9FAFC;
        width: 100%;
        position: fixed;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
    }

    .lateral-aside__bottom-bar__o {
        right: 0;
        width:70%;
        height: 30px;
        padding: 5px 10px;
        background-color: transparent;
        position: fixed;
        box-shadow: 0 -2px 2px 0 rgba(0, 0, 0, .14), 0 -1px 5px 0 rgba(0, 0, 0, .12), 0 -3px 1px -2px rgba(0, 0, 0, 0.2);
    }

    .lateral-aside_content {
        width: 100%;
        height: calc(100% - 87px);
        overflow-y: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin-bottom: 10px;
        margin-top: 37px;
    }

    .lateral-aside_content-panel {
        flex: 1;
        width: 96%;
    }
    .lateral-aside_content-panel-body {
        color: #333333;
        margin-left: 0;
        margin-right: 0;
    }

</style>