<template>
    <div class="footer_panel">
        <div class="container-of-items">
            <div class="item">

            </div>
            <div class="item">
                <bacab-clock/>
            </div>
        </div>
    </div>
</template>

<script>
    import BacabClock from "./components/bacabClock";
    export default {
        name: "bacabPanel",
        components: {BacabClock}
    }
</script>

<style scoped>
    .footer_panel {
        display: flex;
        flex-direction: column;
        min-height: 100%;
        background-color: #394263;
        margin: -16px;
        color: #D3D3D3;
    }
    .container-of-items {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        margin: 0 15px;
    }

    .item {
        margin: 5px 5px;
        display: inline-block;
        text-align: left;
    }
</style>