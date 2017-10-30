//<prj>/the_reactjs/src/views/elements/ElementNavbar.js 1.0.1
import React from "react"
import { connect } from "react-redux"
import { Link } from "react-router-dom"
import ElementComment from "./ElementComment";

const ElementNavbar = (props) => {
    return (  
        <nav className="navbar navbar-expand-md navbar-dark bg-dark mb-4">
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse" id="navbarCollapse">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item active">
                        <a className="nav-link" href="/">
                            Home <span className="sr-only">(current)</span>
                        </a>
                    </li>
                    <li className="nav-item">
                        <a className="nav-link" href="/contact/" >
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    )//return jsx
}//ElementNavbar

export default connect()(ElementNavbar);
    
    