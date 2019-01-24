export default {
    bacabAsideOpenClose(state, payload) {
        state.bacabUIEvents.bacabAsideOpen = payload;
    },
    user(state, payload){
        state.user = payload;
    },
    mexicoStates(state, payload) {
        state.mexicoStates = payload;
    },
    bacabUpdateValue(state, payload){
        switch(payload){
            case 'patients':
                state.bacabUIEvents.reloadValue.patients++;
                break;
        }
    }
}