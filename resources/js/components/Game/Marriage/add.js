import React, { Component } from 'react';
import axios from 'axios';
import toastr from "cogo-toast";


export default class Add extends Component {

       state={
            game:'',
            name:'',
            email:'',
            playerNumber:'',
        }



    handleInput=(event,attr)=>{
        this.setState({
            [attr]:event.target.value
        })
    }




    validate() {
        let email = this.state.email;
        let name = this.state.name;
        let isValid = true;
        console.log(email)
        console.log(name)

        if (!name) {
            isValid = false;
            toastr.error("Please enter player name", {position : 'top-right', heading: 'Error'});;
        }

        if (typeof email!== "undefined"||!email) {

            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

            if (!pattern.test(email)) {
                isValid = false;
                toastr.error("Email address provided is invalid", {position : 'top-right', heading: 'Error'});
            }

        }
        return isValid;
    }


    handleSubmit=(event)=> {
        const {name, email, game} = this.state
        event.preventDefault();
        if (this.validate()) {
            axios.post("/api/players", {
                name: name,
                email: email,
                id: game['id'],
            }).then(response => {
                this.setState({
                    name: '',
                    email: '',
                    playerNumber: response.data['player_number'] + 1,
                })
                if (this.state.game['number_of_players'] == response.data['player_number']) {
                    this.props.history.push(`/add-point/${this.state.game['id']}`);
                }
            }).catch(err => console.log(err));

        }
    }

    componentDidMount=()=>{
        const game=this.props.location.state;
        axios.get(`/api/players/${game.id}`).then(response=>{
            this.setState({
                game:game,
                playerNumber:response.data + 1

            })
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
                                        <input type="text"  className="form-control col-md-3" value={name}  onChange={(e)=>handleInput(e,'name')}   id="player_name" placeholder="Enter player name..."/>

                                        <label className="col-md-3 col-form-label text-md-right" htmlFor="email">Player Email:</label>
                                        <input type="text"  className="form-control col-md-3" value={email}  onChange={(e)=>handleInput(e,'email')}  id="email" placeholder="Enter player email..."/>
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

