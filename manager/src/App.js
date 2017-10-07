import React from 'react'
import { BrowserRouter, Route, HashRouter } from 'react-router-dom'
import Dashboard from './containers/dashboard'
import Logo from './containers/logo'

export default class App extends React.Component {
    render() {
        return (
            <HashRouter>
                <div>
                    <Route exact path='/' component={Dashboard} />
                    <Route path='/logo' component={Logo} />
                </div>
            </HashRouter>
        )
    }
}