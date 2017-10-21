import React from 'react'
import PropTypes from 'prop-types'
import { Provider } from 'react-redux'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import App from '../App'
import Home from './Home'
import Contact from './Contact'
import Status404 from './status/Status404'

const Root = ({ store }) => (
    <Provider store={store}>
        <BrowserRouter>
            <Switch>
                <Route exact path="/" component={Home} />
                <Route exact path="/contact/" component={Contact} />
                <Route component={Status404} />
            </Switch>
        </BrowserRouter>
    </Provider>
)

Root.propTypes = {
  store: PropTypes.object.isRequired
}

export default Root