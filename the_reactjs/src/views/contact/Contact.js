//<prj>/the_reactjs/src/views/Contact.js
import React from "react";
import { connect } from "react-redux"

import ElementFooter from "../../elements/ElementFooter";
import ElementNavbar from "../../elements/ElementNavbar";

const oStyle = {
    center : {
        textAlign:"center"
    },
    left : {
        textAlign:"left"
    }
}

const view_contact = () => {
    return (
        <div>
            <div className="row">
                <br/>
            </div>
            <ElementNavbar/>
            <ElementFooter/>
        </div>
    )//return jsx
}//view_contact

export default connect()(view_contact);