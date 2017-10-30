//<prj>/the_reactjs/src/elements/ElementFooter.js
import React from "react"
import { connect } from "react-redux"

const ElementFooter = (props) => {
    return (
        /*<!--elem_footer 1.0.0-->*/
        <footer className="footer">
            <div className="container">
                <ul className="list-inline">
                    <li className="list-inline-item">
                        <a rel="nofollow" className="btn btn-block" href="/"> 
                            <span className="fa fa-home"></span>
                        </a>
                    </li>
                    <li className="list-inline-item">
                        <a rel="nofollow" className="btn btn-block" target="_blank" href="https://www.facebook.com/elchalan.aruba/"> 
                            <span className="fa fa-facebook-square"></span>
                        </a>
                    </li>            
                    <li className="list-inline-item">
                        <a rel="nofollow" className="btn btn-block" target="_blank" href="https://twitter.com/ELCHALANARUBA"> 
                            <span className="fa fa-twitter-square"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <p>&copy; elchalanaruba.com 2017</p>
        </footer>
        /*<!--/elem_footer 1.0.0-->*/
    )//return jsx
}//ElementFooter

export default connect()(ElementFooter);