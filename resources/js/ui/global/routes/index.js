import Mirror from '../../components/Mirror'
import bacabDashboard from '../../bacabDashboard'
import { layouts } from "./layouts";

import home from './vroutes/home'
import goals from './vroutes/goals'
import projects from './vroutes/projects';




export default [
    {
        path: '',
        redirect: '/dashboard'
    },
    {
        path: '/dashboard',
        component: bacabDashboard,
        props: {
            base: '/dashboard'
        },
        children: [
            {
                path: ':tab',
                component: Mirror,
                children: [
                    ...home(layouts),
                    ...goals(layouts),
                    ...projects(layouts)]
            }
        ]
    }
]
