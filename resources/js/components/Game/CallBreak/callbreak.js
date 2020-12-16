import React, { Component } from 'react';
import {Link} from 'react-router-dom';


export default class Callbreak extends Component {
    render(){
        const mystyle= {
            color:"red",
            fontSize:"20px"
        };
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Choose Game</div>
                            <div className="card-body">
                                <div className="text-center">
                                    <p style={mystyle} className="font-weight-bolder ">This Page is under Construction. Stay Updated</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

