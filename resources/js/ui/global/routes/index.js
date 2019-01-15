import Mirror from '../../components/Mirror'
import bacabDashboard from '../../bacabDashboard'
import { layouts } from "./layouts";

import home from './vroutes/home'
import patients from './vroutes/patients'
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
                    ...patients(layouts),
                    ...projects(layouts)]
            }
        ]
    }
]
