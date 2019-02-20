export default layouts => [
    {
        path: '/or/types',
        component: layouts.proceduresTypes,
        props: route => ({
            path: '/or/types',
            back: false
        })
    }
]
