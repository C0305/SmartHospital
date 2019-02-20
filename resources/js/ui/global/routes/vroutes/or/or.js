import { layouts } from "./layouts";
import procedureTypes from './paths/procedures-types';

export default () => [
    {
        path: 'or/types',
        component: layouts.proceduresTypes,
        props: route => ({
            path: 'or/types',
            back: false
        })
    }
]
