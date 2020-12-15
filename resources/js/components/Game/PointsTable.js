import React, { Component } from 'react';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import {Link} from "react-router-dom";
import axios from 'axios';



toast.configure();

export default class PointsTable extends Component {

        state={
            editStatus:'1',
            data:[],
            totalPoints:[],
            players:[],
            rounds:[],
            gameId:'',
            roundIdArray:[]
        }

    componentDidMount=()=>{
        const gameId= this.props.match.params.gameId
        axios.get(`/api/points-table/${gameId}`).then(response=>{
            this.setState({
                players:response.data['players'],
                rounds:response.data['rounds'],
                gameId:gameId,
                roundIdArray:response.data['roundIdArray'],
            })
        })
    }

    handleDelete=(e,id)=>{
        axios.delete('/api/rounds/'+id).then(response=>{
            toast(response.data,{
                position:"top-center",
                autoClose:3000,
                hideProgressBar:true
            })
            const rounds=this.state.rounds.filter(round => round.id !== id);
                this.setState({
                    rounds
                })

        }).catch(error=>{console.log(error)})

    }

    totalPoint=(id,index)=>{
            const totalPoints=[...this.state.totalPoints]
         axios.get(`/api/player/${id}/points`,{
             params: {
                 roundIdArray:this.state.roundIdArray
             }
         }).then(response=>{
             totalPoints[index]=response.data
                this.setState({
                    totalPoints:totalPoints
                })
             }
         ).catch(error=>{console.log(error)})
    }



    render(){
            const {players,rounds,gameId}=this.state
            const {handleDelete,totalPoint}=this
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">
                                <div className="row">
                                    <div className="col-md-6 text-right"> Total Points Table:</div>
                                    <div className="col-md-6 text-right">
                                        <Link to={{pathname: `/info/${gameId}`}}>Game Info</Link></div>
                                </div>

                            </div>
                            <div className="card-body">
                                <div className="row text-center">
                                     <table className="table table-bordered table-hover text-center table-striped">
                                        <thead>
                                        <tr>
                                            <th>Round</th>
                                            {
                                                    players.map((player)=>(
                                                        <td key={player.id}>
                                                            {player.name}
                                                        </td>
                                                    ))
                                            }
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {
                                            rounds.map((round,index)=>(
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
                                                    <td>
                                                        <button onClick={(e)=>handleDelete(e,round.id)}><i className="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>

                                            ))
                                        }
                                        </tbody>
                                        <tfoot>
                                        <tr className="text-center">
                                            <th>Point:</th>
                                            {
                                                players.map((player,index)=>(
                                                    <th key={player.id}>
                                                       {/*{totalPoint(player.id,index)}*/}
                                                    </th>
                                                ))
                                            }
                                            <th></th>

                                        </tr>
                                        <tr className="text-center">
                                            <th>Amount:</th>
                                            {
                                                players.map((player,index)=>(
                                                    <th key={player.id}>
                                                        {/* {totalPoint(player.id,index)}
                                                        {this.state.totalPoints[index]}*/}
                                                    </th>
                                                ))
                                            }
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <div className="col-md-12">
                                        <div className="col-md-6 text-left">
                                            <Link className="btn btn-light shadow border " to={`/add-point/${gameId}`}>Next Round</Link>
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

