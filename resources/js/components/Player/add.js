import React, { Component } from 'react';



export default class Home extends Component {
    constructor(props) {
        super(props);
        this.state={
            game:'',
            playerName:'',
            email:'',
        }
    this.formElements=this.formElements.bind(this);
    }

    componentDidMount(){
        const game=this.props.location.state;
        this.setState({
            game:game
        })
    }

    formElements(){
        var playerDetail= [];
        for(var i =1; i <= 4; i++){
            playerDetail.push(
                <div className="form-group row mt-2 text-center">
                <label className="col-md-2 col-form-label text-md-right" htmlFor="player_name">Player {i} Name:</label>
                <input type="text" key={`player_name${i}`} className="form-control col-md-3" value={} onClick={}  required  id={`player_name${i}`} placeholder="Enter player name..."/>

                <label className="col-md-3 col-form-label text-md-right" htmlFor="email">Player {i} Email:</label>
                <input type="text" key={`email${i}`} className="form-control col-md-3" value={} onClick={}  id={`email${i}`} placeholder="Enter player email..."/>
                </div>
                );
        }
        return playerDetail;
    }

    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Enter Players Detail</div>
                            <div className="card-body ">
                                <form >
                                    {
                                        this.formElements()
                                    }
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

