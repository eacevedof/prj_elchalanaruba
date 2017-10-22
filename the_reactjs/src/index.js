import React from "react";
import ReactDOM from "react-dom"
import Root from "./views/Root"
import oStore from "./store/store"
import "./index.css";

ReactDOM.render(
    <Root store={oStore} />,
    document.getElementById("divMain")
);
