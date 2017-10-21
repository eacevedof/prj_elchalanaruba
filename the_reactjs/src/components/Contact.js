//<prj>/the_reactjs/src/components/Contact.js
import React from "react";
import { connect } from "react-redux"

import ElementFooter from "./elements/ElementFooter";

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
     
            
            <ElementFooter/>
        </div>
    )//return jsx
}//view_contact

export default connect()(view_contact);