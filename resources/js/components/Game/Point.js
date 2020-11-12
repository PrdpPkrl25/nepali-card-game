import React, {Component} from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';


export default class Point extends Component {

    state = {
        gameId: '',
        players:[],
        playersData: [],

    };


    handleInputChanged = (e, index) => {
        const {playersData}=this.state;
        const playersDataCopy=[...playersData];
        const playersDataObject={...playersDataCopy[index]}
        playersDataObject.point=e.target.value
        playersDataCopy[index]=playersDataObject
        console.log(playersDataCopy)
        this.setState({
            playersData: playersDataCopy
        })
    }

    handleSeenClicked = (e, index) => {
        const {playersData}=this.state;
        const playersDataCopy=[...playersData];
        const playersDataObject={...playersDataCopy[index]}
        playersDataObject.seen=e.target.checked
        playersDataCopy[index]=playersDataObject
        console.log(playersDataCopy)
        this.setState({
            playersData: playersDataCopy
        })
    }

    handleDubliClicked = (e, index) => {
        const {playersData}=this.state;
        const playersDataCopy=[...playersData];
        const playersDataObject={...playersDataCopy[index]}
        playersDataObject.dubli=e.target.checked
        playersDataCopy[index]=playersDataObject
        console.log(playersDataCopy)
        this.setState({
            playersData: playersDataCopy
        })
    }

    handleWinnerClicked = (e, index) => {
        const {playersData}=this.state;
        const playersDataCopy=[...playersData];
        const playersDataObject={...playersDataCopy[index]}
        playersDataObject.winner=e.target.checked
        playersDataCopy[index]=playersDataObject
        console.log(playersDataCopy)
        this.setState({
            playersData: playersDataCopy
        })
    }




    handleSubmit = (event) => {
        const {playersData,gameId} = this.state
        event.preventDefault();
        axios.post("/api/points", {
            playersData: playersData,
            id: gameId,
        }).then(response => {
            this.setState({
               playersData: [],
                gameId: ''
            })
            this.props.history.push('/');
        }).catch(err => console.log(err));

    }

    componentDidMount = () => {
        const players = this.props.location.state;
        const gameId=this.props.match.params;
        console.log(players)
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

    }


    render() {
        const {handleSubmit,handleInputChanged,handleSeenClicked,handleDubliClicked,handleWinnerClicked}=this


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
                                                onChange={(e)=>handleInputChanged(e,index)}
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
                                                onChange={(e)=>handleSeenClicked(e,index)}
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
                                                onChange={(e)=>handleDubliClicked(e,index)}
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
                                                onChange={(e)=>handleWinnerClicked(e,index)}
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

