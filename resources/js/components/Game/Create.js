import React, { Component } from 'react';
import axios from 'axios';



export default class Home extends Component {
    constructor(props) {
        super(props);
        this.state = {
            totalPlayers:'',
            ratePerPoint:'',
            winnerPointPerSeen:'',
            winnerPointPerUnseen:'',
            dubliWinnerPointPerSeen:'',
            dubliWinnerPointPerUnseen:'',
        }
        this.handleFormSubmit=this.handleFormSubmit.bind(this);
        this.handleInputTotalPlayersChange=this.handleInputTotalPlayersChange.bind(this);
        this.handleInputRatePerPointChange=this.handleInputRatePerPointChange.bind(this);
        this.handleInputWinnerPointPerSeenChange=this.handleInputWinnerPointPerSeenChange.bind(this);
        this.handleInputWinnerPointPerUnseenChange=this.handleInputWinnerPointPerUnseenChange.bind(this);
        this.handleInputDubliWinnerPointPerSeenChange=this.handleInputDubliWinnerPointPerSeenChange.bind(this);
        this.handleInputDubliWinnerPointPerUnseenChange=this.handleInputDubliWinnerPointPerUnseenChange.bind(this);
    }


    handleInputTotalPlayersChange(event){
       this.setState({
           totalPlayers:event.target.value
       })
    }

    handleInputRatePerPointChange(event){
        this.setState({
            ratePerPoint:event.target.value
        })
    }

    handleInputWinnerPointPerSeenChange(event){
        this.setState({
            winnerPointPerSeen:event.target.value
        })
    }

    handleInputWinnerPointPerUnseenChange(event){
        this.setState({
            winnerPointPerUnseen:event.target.value
        })
    }

    handleInputDubliWinnerPointPerSeenChange(event){
        this.setState({
            dubliWinnerPointPerSeen:event.target.value
        })
    }

    handleInputDubliWinnerPointPerUnseenChange(event){
        this.setState({
            dubliWinnerPointPerUnseen:event.target.value
        })
    }

    handleFormSubmit(event){
    event.preventDefault();
    axios.post('/api/games',{
        totalPlayers:this.state.totalPlayers,
        ratePerPoint:this.state.ratePerPoint,
        winnerPointPerSeen:this.state.winnerPointPerSeen,
        winnerPointPerUnseen:this.state.winnerPointPerUnseen,
        dubliWinnerPointPerSeen:this.state.dubliWinnerPointPerSeen,
        dubliWinnerPointPerUnseen:this.state.dubliWinnerPointPerUnseen,
    }).then(response=>{
        this.setState({
            totalPlayers:'',
            ratePerPoint:'',
            winnerPointPerSeen:'',
            winnerPointPerUnseen:'',
            dubliWinnerPointPerSeen:'',
            dubliWinnerPointPerUnseen:'',
        })
        this.props.history.push('/add-players',response.data);
        }).catch(err=>console.log(err));

    }
    render(){
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Create New Marriage Game</div>
                            <div className="card-body ">
                                <form onSubmit={this.handleFormSubmit}>
                                    <div className="form-group">
                                        <label htmlFor="total_players">Number of Players(Max 6):</label>
                                        <input type="text" className="form-control" required onChange={this.handleInputTotalPlayersChange} value={this.state.totalPlayers} id="total_players" placeholder="Enter total number of players..."/>
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="rate_per_point">Rate Per Point:</label>
                                        <input type="text" className="form-control" required onChange={this.handleInputRatePerPointChange} value={this.state.ratePerPoint} id="rate_per_point" placeholder="Enter rate per point..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="winner_points_per_seen">Winner Points Per Seen:</label>
                                        <input type="text" className="form-control" required onChange={this.handleInputWinnerPointPerSeenChange} value={this.state.winnerPointPerSeen} id="rate_per_point" placeholder="Enter winner point per seen..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="winner_points_per_unseen">Winner Points Per Unseen:</label>
                                        <input type="text" className="form-control" required onChange={this.handleInputWinnerPointPerUnseenChange} value={this.state.winnerPointPerUnseen} id="rate_per_point" placeholder="Enter winner point per unseen..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="dubli_winner_points_per_seen">Dubli Winner Points Per Seen</label>
                                        <input type="text" className="form-control" required onChange={this.handleInputDubliWinnerPointPerSeenChange} value={this.state.dubliWinnerPointPerSeen} id="rate_per_point" placeholder="Enter dubli winner point per seen..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="dubli_winner_points_per_unseen">Dubli Winner Points Per Unseen</label>
                                        <input type="text" className="form-control" required onChange={this.handleInputDubliWinnerPointPerUnseenChange} value={this.state.dubliWinnerPointPerUnseen} id="rate_per_point" placeholder="Enter dubli point per unseen..."/>
                                    </div>
                                    <button type="submit" className="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

