import React, {Component} from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';


export default class Point extends Component {

    state = {
        gameId: '',
        players:[],
        playersData: [],

    };


    handleInputChanged = (e,index,key) => {
        const {playersData}=this.state;
        const playersDataCopy=[...playersData];
        const playersDataObject={...playersDataCopy[index]}
        playersDataObject[key]=e.target.value
        playersDataCopy[index]=playersDataObject
        console.log(playersDataCopy)
        this.setState({
            playersData: playersDataCopy
        })
    }


    handleWinner = (e, index) => {
        const {playersData}=this.state;
        const playersDataCopy=[...playersData];

        for(let i=0;i<this.state.players.length;i++){
            const playersDataObject={...playersDataCopy[i]}
            playersDataObject.winner=false
            if(i===index){
                playersDataObject.winner=e.target.checked
            }
            playersDataCopy[i]=playersDataObject
        }
        this.setState({
            playersData: playersDataCopy
        })
    }




    handleSubmit = (event) => {
        const {playersData,gameId} = this.state
        event.preventDefault();
        axios.post("/api/points", {
            playersData: playersData,
            gameId: gameId,
        }).then(response => {
            this.setState({
               playersData: [],
                gameId: ''
            })
            this.props.history.push(`/round/${response.data}/table`);
        }).catch(err => console.log(err));

    }

    componentDidMount = () => {
        const gameId=this.props.match.params.gameId;
        axios.get(`/api/players/${gameId}`).then(response=>{
            const players=response.data
            const playersWithRound = players.map(({id}) => ({
                player_id:id,
                point: 0,
                seen: 0,
                dubli: 0,
                winner: 0,

            }));
            this.setState({
                gameId:gameId,
                players:players,
                playersData: playersWithRound
            })
        })



    }


    render() {
        const {handleSubmit,handleInputChanged,handleWinner}=this


        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5">
                            <div className="card-header">
                                <div className="row">
                                    <div className="col-md-6 text-right">Enter Round Point Result:</div>
                                    <div className="col-md-6 text-right"><Link
                                        to={{pathname: `/info/${this.state.gameId}`}}>Game
                                        Info</Link></div>
                                </div>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleSubmit}>
                                    {this.state.players.map((player,index) => (
                                        <div className="form-group row mt-2 text-center" key={player.id}>
                                            <label
                                                className="col-md-2 col-form-label text-md-right"
                                                htmlFor="player_point">
                                                Player {index+1} Point:
                                            </label>
                                            <input
                                                type="text"
                                                className="form-control col-md-2"
                                                required
                                                id="player_point"
                                                name="points"
                                                onChange={(e)=>handleInputChanged(e,index,"point")}
                                                placeholder="Enter player point..."
                                            />

                                            <label
                                                className="col-md-2 col-form-label text-md-right"
                                                htmlFor="seen">
                                                Seen Status:
                                            </label>
                                            <input
                                                id="seen"
                                                type="checkbox"
                                                className="form-control col-md-1"
                                                name="seen"
                                                onChange={(e)=>handleInputChanged(e,index,"seen")}
                                            />

                                            <label
                                                className="col-md-2 col-form-label text-md-right"
                                                htmlFor="dubli">
                                                Dubli Played:
                                            </label>

                                            <input
                                                id="dubli"
                                                type="checkbox"
                                                className="form-control col-md-1"
                                                name="dubli"
                                                onChange={(e)=>handleInputChanged(e,index,"dubli")}
                                            />
                                        </div>
                                    ))}
                                    <div className="row text-center mt-4">
                                        <div className="col-md-12 " >
                                            <span>Winner</span>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div className="form-group row mt-2 text-center">
                                        {this.state.players.map((player,index)=>(
                                            <div className="col-md-3" key={player.id}>
                                            <input
                                                id="winner"
                                                type="radio"
                                                className="form-control"
                                                name="winner"
                                                onChange={(e)=>handleWinner(e,index)}
                                            />

                                            <label htmlFor="winner"
                                            className="col-form-label text-md-right">
                                            {player.name}
                                            </label>
                                            </div>
                                        ))
                                        }

                                    </div>
                                    <div className="form-group row mb-0">
                                        <div className="col-md-3 offset-md-4  text-center">
                                            <button type="submit" className="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

