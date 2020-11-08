import React, { Component } from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';


export default class PointsTable extends Component {
    constructor(props) {
        super(props);
        this.state={
            totalPoints:[],
            players:[],
            rounds:[],


        }


    }



    componentDidMount(){
        const gameId= this.props.match.params.id
        axios.get(`/api/points-table/${gameId}`).then(response=>{
            console.log(response.data['rounds'].points)
            this.setState({
                totalPoints:response.data['points'],
                players:response.data['players'],
                rounds:response.data['rounds']
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
                                                <tr>
                                                    <td key={round.id}>
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

                                    <Link className="btn btn-light shadow border offset-md-1" to="/">Next Round</Link>
                                    <Link className="btn btn-light shadow border offset-md-2" to="/">Total points</Link>
                                    <Link className="btn btn-warning shadow border offset-md-4" to="/marriage/start">New Game</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

