//<project>/the_reactjs/src/views/Root.js 1.0.0
import React from 'react'
import PropTypes from 'prop-types'
import { Provider } from 'react-redux'
import { BrowserRouter, Route, Switch } from 'react-router-dom'
import Home from './homes/Home'
import Contact from './contact/Contact'
import Dishes from './contact/Contact'
import Status404 from './status/Status404'

const Root = ({ store }) => (
    <Provider store={store}>
        <BrowserRouter>
            <Switch>
                <Route exact path="/" component={Home} />
                <Route exact path="/contact/" component={Contact} />
                <Route exact path="/dishes/" component={Dishes} />
                <Route path="*" component={Status404} />
            </Switch>
        </BrowserRouter>
    </Provider>
)

Root.propTypes = {
  store: PropTypes.object.isRequired
}

export default Root