export default {
    bacabAsideOpenClose(context, payload){
        context.commit('bacabAsideOpenClose', payload)
    },

    bacabFirstData(context) {
        axios.get('/show').then( r => {
            context.commit('user', r.data.user);
        });
    }
}