import React, { Component } from 'react';
import {Link} from 'react-router-dom';


export default class Select extends Component {
    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Choose Game</div>
                            <div className="card-body ">
                                <div className="row">
                                    <div className="col-md-6">
                                        <Link to='/marriage/start' className='btn btn-primary'>Marriage</Link>
                                    </div>
                                    <div className="col-md-6 text-right">
                                        <Link to='/callbreak/start' className='btn btn-primary'>Call Break</Link>
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

