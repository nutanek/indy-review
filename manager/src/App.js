import React from 'react'
import { Route, HashRouter } from 'react-router-dom'
import Dashboard from './containers/dashboard'
import Logo from './containers/logo'
import Tones from './containers/tones'

export default class App extends React.Component {
    render() {
        return (
            <HashRouter>
                <div>
                    <Route exact path='/' component={Dashboard} />
                    <Route path='/logo' component={Logo} />
                    <Route path='/tones' component={Tones} />
                </div>
            </HashRouter>
        )
    }
}