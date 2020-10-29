import React, { Component } from 'react';
import axios from 'axios';


export default class Add extends Component {
    constructor(props) {
        super(props);
        this.state={
            game:'',
            playerName:'',
            email:'',
            playerNumber:1,
        }
        this.handleEmail=this.handleEmail.bind(this);
        this.handlePlayerName=this.handlePlayerName.bind(this);
        this.handleSubmit=this.handleSubmit.bind(this);
    }

    handlePlayerName(event){
        this.setState({
            playerName:event.target.value
        })
    }

    handleEmail(event){
        this.setState({
            email:event.target.value
        })
    }

    handleSubmit(event){
        event.preventDefault();
        axios.post("/api/players",{
            playerName:this.state.playerName,
            email:this.state.email,
            id:this.state.game['id'],
        }).then(response=>{
            this.setState({
                playerName:'',
                email:'',
                playerNumber:response.data['player_number']+1,
            })
            if (this.state.game['number_of_players']==response.data['player_number']){
                this.props.history.push(`/add-point/${this.state.game['id']}`,this.state.game);
            }
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
                            <div className="card-header">Enter Player ({this.state.playerNumber}) Detail</div>
                            <div className="card-body ">
                                <form onSubmit={this.handleSubmit}>
                                    <div className="form-group row mt-2 text-center">
                                        <label className="col-md-2 col-form-label text-md-right" htmlFor="player_name">Player Name:</label>
                                        <input type="text"  className="form-control col-md-3" value={this.state.playerName} onChange={this.handlePlayerName}  required  id="player_name" placeholder="Enter player name..."/>

                                        <label className="col-md-3 col-form-label text-md-right" htmlFor="email">Player Email:</label>
                                        <input type="text"  className="form-control col-md-3" value={this.state.email} onChange={this.handleEmail}  id="email" placeholder="Enter player email..."/>
                                    </div>
                                    <div className="form-group row mb-0">
                                        <div className="col-md-3 offset-md-5  text-center">
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

