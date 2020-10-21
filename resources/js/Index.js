import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Switch, Route} from "react-router-dom";
import Home from "./components/Home";
import Create from "./components/Game/Create"
import Add from "./components/Player/add"

export default class Index extends Component {
    render(){
        return (
            <BrowserRouter>
                <Switch>
                    <Route path="/" exact component={Home} />
                    <Route path="/create-game" exact component={Create} />
                    <Route path="/add-players" exact component={Add} />
                </Switch>
            </BrowserRouter>
    );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Index />, document.getElementById('app'));
}
