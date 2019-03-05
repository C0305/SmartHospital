export default {
    bacabAsideOpenClose(context, payload){
        context.commit('bacabAsideOpenClose', payload)
    },

    bacabFirstData(context) {
        axios.get('/show').then( r => {
            context.commit('user', r.data.user);
            context.commit('mexicoStates', r.data.mexicoStates);
            context.commit('menu', r.data.menu);
        });
    },
    bacabUpdateValue(context, payload){
        context.commit('bacabUpdateValue',payload);
    }
}