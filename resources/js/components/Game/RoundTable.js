import React, { Component } from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';


export default class RoundTable extends Component {

        state={
            roundData:[],
            roundInfo:'',

        }



    componentDidMount=()=>{
        const roundId= this.props.match.params.roundId
        axios.get(`/api/points/${roundId}`).then(response=>{
            this.setState({
                roundData:response.data['points'],
                roundInfo:response.data['round']


            })
        })
    }


    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">
                                Round Point Table:
                            </div>
                            <div className="card-body">
                                <div className="row text-center">
                                    <table className="table table-bordered table-hover text-center table-striped">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Scored</th>
                                            <th><span className="glyphicon glyphicon-eye-open"></span></th>
                                            <th><span className="glyphicon glyphicon-duplicate"></span></th>
                                            <th><span className="glyphicon glyphicon-king"></span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {
                                            this.state.roundData.map(data=>(
                                                <tr key={data.id}>
                                                    <td>{data.player.name}</td>
                                                    <td>
                                                        {data.point_scored}
                                                    </td>
                                                    <td>
                                                        {data.seen==1?(<span className="glyphicon glyphicon-ok"></span>):
                                                            <span className="glyphicon glyphicon-remove"></span>}
                                                    </td>
                                                    <td>
                                                        {data.dubli==1&&<span className="glyphicon glyphicon-ok"></span>}
                                                    </td>
                                                    <td>
                                                        {data.winner==1&&<span className="glyphicon glyphicon-ok"></span>}
                                                    </td>
                                                </tr>
                                                ))
                                        }
                                        </tbody>
                                        <tfoot>
                                        <tr className="text-center">
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <div className="col-md-12">
                                      <div className="col-md-6 text-left">
                                          <Link className="btn btn-light shadow border " to={`/add-point/${this.state.roundInfo.game_id}`}>Next Round</Link>
                                      </div>
                                      <div className="col-md-6 text-right">
                                          <Link className="btn btn-light shadow border " to={`/points/table/${this.state.roundInfo.game_id}`}>Total points</Link>
                                      </div>
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

