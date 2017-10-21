//<prj>/the_reactjs/src/components/Status404.js
import React from "react";
import { connect } from "react-redux"
import ElementFooter from "../elements/ElementFooter";

const view_contact = () => {
    return (
        <div>
            Error 404
        </div>
    )//return jsx
}//view_contact

export default connect()(view_contact);