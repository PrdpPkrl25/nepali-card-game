import React, { Component } from 'react';
import axios from 'axios';


export default class Add extends Component {

       state={
            game:'',
            name:'',
            email:'',
            playerNumber:1,
        }



    handleInput=(event,attr)=>{
        this.setState({
            [attr]:event.target.value
        })
    }


    handleSubmit=(event)=>{
            const {name,email,game}=this.state
            event.preventDefault();
            axios.post("/api/players",{
                playerName:name,
                email:email,
                id:game['id'],
            }).then(response=>{
                this.setState({
                    name:'',
                    email:'',
                    playerNumber:response.data['player_number']+1,
                })
                if (this.state.game['number_of_players']==response.data['player_number']){
                    this.props.history.push(`/add-point/${this.state.game['id']}`);
                }
            }).catch(err=>console.log(err));

    }

    componentDidMount=()=>{
        const game=this.props.location.state;
        this.setState({
            game:game
        })
    }


    render(){
           const {handleInput,handleSubmit}=this
           const {name,email}=this.state
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Enter Player ({this.state.playerNumber}) Detail</div>
                            <div className="card-body ">
                                <form onSubmit={handleSubmit}>
                                    <div className="form-group row mt-2 text-center">
                                        <label className="col-md-2 col-form-label text-md-right" htmlFor="player_name">Player Name:</label>
                                        <input type="text"  className="form-control col-md-3" value={name} onChange={(e)=>handleInput(e,name)}  required  id="player_name" placeholder="Enter player name..."/>

                                        <label className="col-md-3 col-form-label text-md-right" htmlFor="email">Player Email:</label>
                                        <input type="text"  className="form-control col-md-3" value={email} onChange={(e)=>handleInput(e,email)}  id="email" placeholder="Enter player email..."/>
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

