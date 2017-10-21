//<prj>/the_reactjs/src/components/ProductList.js
import React from "react";
import { AcCart } from "../actions/ac_cart"
import { connect } from "react-redux"

//get_fields,get_dispatchers
const view_productlist = ({ arProducts, fnAddToCart }) => {
    console.log("CONTACT.view_productlist.render()")
    
    return (
        <div>

        </div>
    )//render
}//view_productlist

const get_fields = (oState)=>{
    console.log("CONTACT.get_fields return oStateNew con arProducts")
    let oStateNew = {
        arProducts : oState.arProducts
    }
    return oStateNew
}//get_fields

const get_dispatchers = fnDispatch => {
    console.log("CONTACT.get_dispatchers devuelve oDispatch")
    let oDispatch = {
        fnLoadProducts : arProducts => {
            console.log("CONTACT.get_dispatchers.oDispatch.fnLoadProducts")
            let oAction = AcProduct.load(arProducts)
            fnDispatch(oAction)
        },
        fnAddToCart : oProduct => {
            console.log("CONTACT.get_dispatchers.oDispatch.fnAddToCart")
            let oAction = AcCart.add(oProduct)
            fnDispatch(oAction)
        }
    }
    return oDispatch
}//get_dispatchers

export default connect(get_fields,get_dispatchers)(view_productlist);