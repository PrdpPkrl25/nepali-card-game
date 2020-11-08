import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter, Switch, Route} from "react-router-dom";
import Home from "./components/Home";
import Create from "./components/Game/Create"
import Add from "./components/Player/add"
import Point from "./components/Game/Point"
import Info from "./components/Game/Info"
import Select from "./components/Game/Select";
import RoundTable from "./components/Game/RoundTable"
import PointsTable from "./components/Game/PointsTable"

export default class Index extends Component {
    render(){
        return (
            <BrowserRouter>
                <Switch>
                    <Route path="/" exact component={Home} />
                    <Route path="/select/game" exact component={Select} />
                    <Route path="/marriage/start" exact component={Create} />
                    <Route path="/add-players/:id" exact component={Add} />
                    <Route path="/add-point/:id" exact component={Point} />
                    <Route path="/info/:id" exact component={Info} />
                    <Route path="/round/:id/table" exact component={RoundTable} />
                    <Route path="/points/table/:id" exact component={PointsTable} />
                </Switch>
            </BrowserRouter>
    );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<Index />, document.getElementById('app'));
}
