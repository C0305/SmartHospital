export default layouts => [
    {
        path: 'goals',
        component: layouts.goals,
        props: route => ({
            path: 'goals',
            back: false
        })
    }
]
