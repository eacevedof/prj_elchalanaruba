//<prj>/the_reactjs/src/components/elements/ElementNavbar.js 1.0.0
import React from "react"
import { connect } from "react-redux"
import { Link } from "react-router-dom"

const ElementNavbar = (props) => {
    return (  
        <div className="row">
            <nav className="navbar navbar-toggleable-md navbar-light bg-faded">
                <button className="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <a className="navbar-brand" href="#">El Chalán - Aruba</a>
                <div className="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul className="navbar-nav">
                        <li className="nav-item active">
                            <Link to="/">Home</Link>
                        </li>
                        <li className="nav-item">
                            <Link to="/contact/">Contact</Link>
                        </li>
                        <li className="nav-item">
                            <Link to="/dishes/">Dishes</Link>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    )//return jsx
}//ElementNavbar

export default connect()(ElementNavbar);
    
    