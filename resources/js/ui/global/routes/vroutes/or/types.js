export default layouts => [
    {
        path: 'procedure-type',
        component: layouts.or.types,
        props: route => ({
            path: 'procedure-type',
            back: false
        })
    }
]
