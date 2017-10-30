//<prj>/the_reactjs/src/views/elements/ElementCarousel.js 1.0.0
import React from "react"
import { connect } from "react-redux"
import { Link } from "react-router-dom"
import "./Carousel.css"

const ElementCarousel = (props) => {
    return (  
        <div className="jumbotron jumbotron-noback" itemscope itemtype="http://schema.org/Restaurant">
            <h1 itemprop="name">
                <span className="badge badge-default">El Chalán Aruba</span>
            </h1>
            <h2 itemprop="description">
                The Best <span itemprop="servesCuisine">Peruvian</span> Cuisine
            </h2>
            <div id="carouselExampleControls" className="carousel slide col-lg-12" data-ride="carousel">
                <div className="carousel-inner" role="listbox">
                    <div className="carousel-item active">
                        <img className="mx-auto d-block img-fluid" src="https://scontent.fmad3-8.fna.fbcdn.net/v/t1.0-9/17156040_429150724099395_6365602522345009275_n.jpg?oh=9c1999b8ad896a645dc3a0befed4e12a&oe=5A749532" alt="First slide"/>
                    </div>
                    <div className="carousel-item">
                        <img className="mx-auto d-block img-fluid" src="https://scontent.fmad3-8.fna.fbcdn.net/v/t1.0-9/13177628_270159969998472_2075784449577850807_n.jpg?oh=4449072c4bc9978c2d367252fea4158d&oe=5AA89E68" alt="Second slide"/>
                    </div>
                </div>
                <a className="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span className="sr-only">Previous</span>
                </a>
                <a className="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span className="carousel-control-next-icon" aria-hidden="true"></span>
                    <span className="sr-only">Next</span>
                </a>
            </div>
        </div>
    )//return jsx
}//ElementCarousel

export default connect()(ElementCarousel);
    
    