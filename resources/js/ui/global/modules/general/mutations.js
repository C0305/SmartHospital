export default {
    bacabAsideOpenClose(state, payload) {
        state.bacabUIEvents.bacabAsideOpen = payload;
    },
    user(state, payload){
        state.user = payload;
    }
}