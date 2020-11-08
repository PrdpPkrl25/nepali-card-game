import React, { Component } from 'react';
import {Link} from "react-router-dom";
import axios from 'axios';


export default class Point extends Component {
    constructor(props) {
        super(props);
        this.state={
            game:'',
            players:[
                {id:1,name:'A'},
                {id:2,name:'B'},
                {id:3,name:'C'},
                {id:4,name:'D'},
            ],
            points:[],
            seen:[],
            dubli:[],
            winner:'',

        }
        this.handlePlayerSeen=this.handlePlayerSeen.bind(this);
        this.handlePlayerPoint=this.handlePlayerPoint.bind(this);
        this.handlePlayerDubli=this.handlePlayerDubli.bind(this);
        this.handleSubmit=this.handleSubmit.bind(this);
    }

    handlePlayerPoint(e,id){

       this.state.points[id]=e.target.value;
        this.setState({
        points:this.state.points
        })
    }

    handlePlayerSeen(e,id){
        this.state.seen[id]=e.target.value;
        this.setState({
            seen:this.state.seen
        })
    }

    handlePlayerDubli(e,id){
        this.state.dubli[id]=e.target.value;
        this.setState({
            dubli:this.state.dubli
        })
    }

    handleSubmit(event){
        event.preventDefault();
        axios.post("/api/points",{
            points:this.state.points,
            seen:this.state.seen,
            dubli:this.state.dubli,
            game:this.state.game,
            id:this.state.game['id'],
        }).then(response=>{
            this.setState({
                points:'',
                seen:[],
                dubli:[],
                winner:''
            })
            this.props.history.push('/');
        }).catch(err=>console.log(err));

    }

    componentDidMount(){
        const game=this.props.location.state;
        this.setState({
            game:game
        })

    }


    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">
                                <div className="row">
                                    <div className="col-md-6 text-right">Enter Round Point Result:</div>
                                    <div className="col-md-6 text-right"><Link to={{pathname:`/info/${this.state.game['id']}`,state:this.state.game}} >Game Info</Link></div>
                                </div>
                            </div>
                            <div className="card-body">
                                <form onSubmit={this.handleSubmit}>
                                    {this.state.players.map(player=>(
                                        <div className="form-group row mt-2 text-center" key={player.id}>
                                            <label className="col-md-2 col-form-label text-md-right" htmlFor="player_point">Player {player.id} Point:</label>
                                            <input type="text"  className="form-control col-md-2"  onChange={this.handlePlayerPoint(player.id)}  required  id="player_point" name="points" placeholder="Enter player point..."/>

                                            <label className="col-md-2 col-form-label text-md-right" htmlFor="seen">Seen Status:</label>
                                            <input id="seen" type="checkbox" className="form-control col-md-1"  onChange={this.handlePlayerSeen(player.id)} name="seen"  />

                                            <label className="col-md-2 col-form-label text-md-right" htmlFor="dubli">Dubli Played:</label>
                                            <input id="dubli" type="checkbox" className="form-control col-md-1" onChange={this.handlePlayerDubli(player.id)} name="dubli" />
                                        </div>
                                    ))}

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

