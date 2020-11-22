import React, { Component } from 'react';
import {Link} from 'react-router-dom';


export default class Home extends Component {
    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Welcome to Cards Game Application</div>
                            <div className="card-body ">
                                <div className="row">
                                    <div className="col-md-6">
                                        <Link to='/select/game' className='btn btn-primary'>New Game</Link>
                                    </div>
                                    <div className="col-md-6 text-right">
                                        <Link to='/view' className='btn btn-primary'>View Game</Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

