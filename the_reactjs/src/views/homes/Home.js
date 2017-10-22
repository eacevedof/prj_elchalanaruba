//<prj>/the_reactjs/src/views/Home.js
import React from "react";
import { connect } from "react-redux"

import ElementNavbar from "../../elements/ElementNavbar";
import ElementFooter from "../../elements/ElementFooter";

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
        <div>

            <div className="row">
                <br/>
            </div>
    
            <div className="row">
                <div className="col-lg-12" style={oStyle.center}>
                    <a rel="nofollow" target="_blank" href="https://www.facebook.com/elchalan.aruba/"> 
                        <img src="https://scontent-mia3-1.xx.fbcdn.net/v/t1.0-9/17156040_429150724099395_6365602522345009275_n.jpg?oh=5b2f35183c710fac81dd963b390d565c&oe=5A257B32" alt="El Chalán Aruba - Peruvian Restaurant" className="img-fluid"/>
                    </a>
                </div>            
            </div>

            <div className="row">
                <div className="col-lg-12" style={oStyle.center}>
                    <br/>
                    <h1 className="display-4">El Chalán in Aruba </h1>
                    <h2 className="display-4">The Best Peruvian Cuisine</h2>
                </div>
            </div>

            <div className="row">
                <p className="col-lg-4"></p>
                <p className="col-lg-4" style={oStyle.left}>
                    <b>Address:</b> Caya G. F. Betico Croes 152, Oranjestad, Aruba <br/>
                    <b>Hours:</b> <br/> 
                    &nbsp;&nbsp;&nbsp;&nbsp;Monday  11:30AM–6PM <br/>
                    &nbsp;&nbsp;&nbsp;&nbsp;Tuesday - Sunday    11:30AM–9PM <br/>
                    <b>Phone:</b> +297 582 7591 <br/>
                    <b>Email:</b> elchalanaruba@gmail.com <br/> 
                    <b>Facebook:</b> https://www.facebook.com/elchalan.aruba <br/>
                    <b>Twitter:</b> https://twitter.com/ELCHALANARUBA <br/><br/>
                    <a href="mailto:elchalanaruba@gmail.com" style={oStyle.center}>
                        <button className="btn btn-large btn-primary">Contact us</button>
                    </a>
                </p>
                <p className="col-lg-4"></p>
            </div>      
            
            <ElementFooter/>
        </div>
    )//return jsx
}//view_home

export default connect()(view_home);