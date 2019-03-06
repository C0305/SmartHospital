export default {
    bacabAside(state, payload) {
        state.bacabUIEvents.bacabAsideOpen = payload;
    },
    bacabSimpleAside(state) {
        state.bacabUIEvents.bacabSimpleAsideStatus = !state.bacabUIEvents.bacabSimpleAsideStatus;
    },
    user(state, payload){
        state.user = payload;
    },
    mexicoStates(state, payload) {
        state.mexicoStates = payload;
    },
    menu(state, payload) {
        state.menu = payload;
    },
    bacabUpdateValue(state, payload){
        switch(payload){
            case 'patients':
                state.bacabUIEvents.reloadValue.patients++;
                break;
        }
    }
}