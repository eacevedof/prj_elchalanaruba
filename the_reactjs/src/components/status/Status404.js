//<prj>/the_reactjs/src/components/Status404.js
import React from "react";
import { connect } from "react-redux"
import ElementFooter from "../elements/ElementFooter";
import "./Status.css"

const view_contact = () => {
    return (
        <div className="">
            <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylessheet"/>

            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <div className="error-template">
                            <h1>
                                Oops!</h1>
                            <h2>
                                404 Not Found</h2>
                            <div className="error-details">
                                Sorry, an error has occured, Requested page not found!
                            </div>
                            <div className="error-actions">
                                <a href="/" className="btn btn-primary btn-lg">
                                    <span className="glyphicon glyphicon-home"></span>
                                    Take Me Home 
                                </a>
                                <a href="http://www.elchalanaruba.com/contact/" className="btn btn-default btn-lg">
                                    <span className="glyphicon glyphicon-envelope"></span> Contact Support 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )//return jsx
}//view_contact

export default connect()(view_contact);