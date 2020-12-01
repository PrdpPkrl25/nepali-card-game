import React, {Component} from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';
import toastr from 'cogo-toast';


export default class Point extends Component {

    state = {
        gameId: '',
        players:[],
        input: [],
        error:{},
        disabled:[]

    };


    handleInputChanged = (e,index) => {
        const input=[...this.state.input];
        const inputObject={...input[index]}
        inputObject[e.target.name]=e.target.value
        input[index]=inputObject
        this.setState({
            input
        })
    }

    handleSeen=(e,index)=>{
        const input=[...this.state.input];
        const disabled=[...this.state.disabled]
        const inputObject={...input[index]}
        const disabledObject={...disabled[index]}
        console.log(disabledObject)
        inputObject[e.target.name]=e.target.value
        disabledObject['disabled']=!disabledObject.disabled
        input[index]=inputObject
        disabled[index]=disabledObject
        console.log(disabled)
        this.setState({
            input,
            disabled
        })
    }

    handleWinner = (e, index) => {
        const input=[...this.state.input];
        for(let i=0;i<this.state.players.length;i++){
            const inputObject={...input[i]}
            inputObject.winner=false
            if(i===index){
                inputObject.winner=e.target.checked
            }
            input[i]=inputObject
        }
        this.setState({
            input
        })
    }


    handleSubmit = (event) => {
        const {input,gameId} = this.state
        event.preventDefault();
        axios.post("/api/points", {input, gameId}).then(response => {
            this.setState({
                input: [],
                gameId: ''
            })
            this.props.history.push(`/round/${response.data}/table`);
        }).catch(error=>{

                toastr.error(error.response.data.errors.winner[0], {position : 'top-right', heading: 'Error'});


        });

    }

    componentDidMount = () => {
        const gameId=this.props.match.params.gameId;
        axios.get(`/api/players/${gameId}`).then(response=>{
            const players=response.data
            const input = players.map(({id}) => ({
                player_id:id,
                point: 0,
                seen: 0,
                dubli: 0,
                winner: 0,

            }));
            const disabled = players.map(({id}) => ({
                disabled:true

            }));
            this.setState({
               gameId, players, input,disabled
            })
        })

    }


    render() {
        const {handleSubmit,handleInputChanged,handleWinner,handleSeen}=this
        const {players,gameId,input,disabled}=this.state

        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5">
                            <div className="card-header">
                                <div className="row">
                                    <div className="col-md-6 text-right">Enter Round Point Result:</div>
                                    <div className="col-md-6 text-right">
                                        <Link to={{pathname: `/info/${gameId}`}}>Game Info</Link></div>
                                </div>
                            </div>
                            <div className="card-body">
                                <form onSubmit={handleSubmit}>
                                    {players.map((player,index) => (
                                        <div className="form-group row mt-2 text-center" key={player.id}>
                                            <label
                                                className="col-md-2 col-form-label text-md-right"
                                                htmlFor="point">
                                                Player {index+1} Point:
                                            </label>
                                            <input
                                                type="text"
                                                className="form-control col-md-2"
                                                id="point"
                                                name="point"
                                                value={input['point']}
                                                disabled={(disabled[index].disabled)?"disabled":""}
                                                onChange={(e)=>handleInputChanged(e,index)}
                                                placeholder="Enter point..."
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
                                                onChange={(e)=>handleSeen(e,index)}
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
                                                onChange={(e)=>handleInputChanged(e,index)}
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
                                        {players.map((player,index)=>(
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

