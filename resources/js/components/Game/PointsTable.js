import React, { Component } from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';


export default class PointsTable extends Component {

        state={
            totalPoints:[],
            players:[],
            rounds:[],
            gameId:''


        }



    componentDidMount=()=>{
        const gameId= this.props.match.params.gameId
        axios.get(`/api/points-table/${gameId}`).then(response=>{
            this.setState({
                totalPoints:response.data['points'],
                players:response.data['players'],
                rounds:response.data['rounds'],
                gameId:gameId,
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
                                Total Points Table:
                            </div>
                            <div className="card-body">
                                <div className="row text-center">
                                     <table className="table table-bordered table-hover text-center table-striped">
                                        <thead>
                                        <tr>
                                            <th>Round</th>
                                            {
                                                    this.state.players.map((player)=>(
                                                        <td key={player.id}>
                                                            {player.name}
                                                        </td>
                                                    ))
                                            }
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {
                                            this.state.rounds.map((round,index)=>(
                                                <tr key={round.id}>
                                                    <td >
                                                        {index+1}
                                                    </td>
                                                    {
                                                        round.points.map((point)=>(
                                                            <td key={point.id}>
                                                                {point.point_scored}
                                                            </td>
                                                        ))
                                                    }
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
                                            <Link className="btn btn-light shadow border " to={`/add-point/${this.state.gameId}`}>Next Round</Link>
                                        </div>

                                        <div className="col-md-6 text-right">
                                            <Link className="btn btn-warning shadow border offset-md-4" to="/marriage/start">New Game</Link>
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

