//<prj>/the_reactjs/src/views/elements/ElementComment.js 1.0.0
import React from "react"
import { connect } from "react-redux"

const ElementComment = (props) => {
    console.log(props)
    let sText = "hola"

    return `<!-- ${sText} -->`;
}//ElementComment

export default connect()(ElementComment);
    
    