//<prj>/the_reactjs/src/views/Home.js
import React from "react";
import { connect } from "react-redux"

import ElementNavbar from "../../elements/ElementNavbar";
import ElementCarousel from "../../elements/ElementCarousel";
import ElementCards from "../../elements/ElementCards";
import ElementFooter from "../../elements/ElementFooter";

//aplicar estilos a los componentes
//https://medium.com/@aghh1504/4-four-ways-to-style-react-components-ac6f323da822
const oStyle = {
    center : {
        textAlign:"center"
    },
    left : {
        textAlign:"left"
    }
}

const view_home = (props) => {
    return (
        <div className="container">
            <header className="masthead">
                <h3 className="text-muted"></h3>
                <ElementNavbar/>
            </header>
            <main role="main">
                <ElementCarousel/>
                <ElementCards/>
            </main>
            <ElementFooter/>
        </div>
    )//return jsx
}//view_home

export default connect()(view_home);