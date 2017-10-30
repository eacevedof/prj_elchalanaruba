//<prj>/the_reactjs/src/views/elements/ElementCards.js 1.0.0
import React from "react"
import { connect } from "react-redux"
import { Link } from "react-router-dom"

//<div className="jumbotron" style="padding:10px;background: none; border:1px solid #ccc; border-radius: 10px;text-align: center;">
const ElementCards = (props) => {
    return (  
        <div class="row">
            <div class="card col-lg-4">
                <img src="https://scontent.fmad3-8.fna.fbcdn.net/v/t1.0-9/14681566_353944934953308_7560627502443153034_n.jpg?oh=cdb2f7fa309ac9ec280addb9fc77fe20&oe=5A6F1178" alt="El Chalán Aruba - Location" class="card-img-top img-fluid"/>
                <div class="card-block">
                    <h4 class="card-title">Location</h4>
                    <p class="card-text">
                        Address: Caya G. F. Betico Croes 152, <br/>
                        Oranjestad <br/> 
                        <b>Aruba</b>
                    </p>
                    <a class="btn btn-primary" href="https://www.facebook.com/elchalan.aruba/" target="_blank" rel="nofollow" role="button">View details &raquo;</a>
                </div>
            </div>
            <div class="card col-lg-4">
                <img src="https://scontent.fmad3-8.fna.fbcdn.net/v/t1.0-9/14502831_350110642003404_6979109429802479096_n.jpg?oh=356b0d0e12e3669c91e1cfe94429b7c2&oe=5A76D7A5" alt="El Chalán Aruba - Opening Hours" class="card-img-top img-fluid"/>
                <div class="card-block">
                    <h4>Opening hours</h4>
                    <p class="card-text">
                        Monday 11:30AM – 6:00PM <br/>
                        Tuesday - Sunday 11:30AM – 9:00PM 
                    </p>
                    <a class="btn btn-primary" href="https://www.facebook.com/elchalan.aruba/" target="_blank" rel="nofollow" role="button">View details &raquo;</a>
                </div>
            </div> 
            <div class="card col-lg-4">
                <div class="card-block">
                    <img src="https://scontent.fmad3-8.fna.fbcdn.net/v/t1.0-9/14517530_345215272492941_8610720983203743580_n.jpg?oh=c9b5472486bf45173465502b001bc4c4&oe=5A69705C" alt="El Chalán Aruba - Contact us" class="img-fluid"/>                                        
                    <h4>Contact us</h4>
                    <p class="card-text">
                        <b>Phone:</b> +297 582 7591 <br/>
                        <b>Email:</b> elchalanaruba@gmail.com <br/>
                        <b>Facebook:</b> https://www.facebook.com/elchalan.aruba <br/>
                        <b>Twitter:</b> https://twitter.com/ELCHALANARUBA 
                    </p>
                    <a class="btn btn-primary" href="https://www.facebook.com/elchalan.aruba/" target="_blank" rel="nofollow" role="button">View details &raquo;</a>
                </div>
            </div>
        </div>     
    )//return jsx
}//ElementCards

export default connect()(ElementCards);
    
    