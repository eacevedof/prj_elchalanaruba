//<prj>/the_reactjs/src/views/elements/ElementComment.js 1.0.0
import React from "react"
import { connect } from "react-redux"

const ElementComment = (props) => {
    let sText = props.text
    if(this.props.trim!==undefined){
        sText = sText.trim()
    }

    return `<!-- ${sText} -->`;
}//ElementComment

export default connect()(ElementComment);
    
    