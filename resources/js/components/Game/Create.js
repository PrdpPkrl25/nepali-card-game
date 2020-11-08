import React, { Component } from 'react';
import axios from 'axios';



export default class Create extends Component {
        state = {
            totalPlayers:'4',
            ratePerPoint:'1',
            winnerPointPerSeen:'3',
            winnerPointPerUnseen:'10',
            dubliWinnerPointPerSeen:'5',
            dubliWinnerPointPerUnseen:'10',
        };


    handleInputChange=(event,attr)=>{
       this.setState({
           [attr]:event.target.value
       })
    };


    handleFormSubmit=(event)=>{
            const {totalPlayers,ratePerPoint,winnerPointPerSeen,winnerPointPerUnseen,dubliWinnerPointPerSeen,dubliWinnerPointPerUnseen} = this.state
    event.preventDefault();
    axios.post('/api/games',{
        totalPlayers:totalPlayers,
        ratePerPoint:ratePerPoint,
        winnerPointPerSeen:winnerPointPerSeen,
        winnerPointPerUnseen:winnerPointPerUnseen,
        dubliWinnerPointPerSeen:dubliWinnerPointPerSeen,
        dubliWinnerPointPerUnseen:dubliWinnerPointPerUnseen,
    }).then(response=>{
        this.setState({
            totalPlayers:'',
            ratePerPoint:'',
            winnerPointPerSeen:'',
            winnerPointPerUnseen:'',
            dubliWinnerPointPerSeen:'',
            dubliWinnerPointPerUnseen:'',
        })
        this.props.history.push(`/add-players/${response.data['id']}`,response.data);
        }).catch(err=>console.log(err));

    };

    render(){
            const {handleFormSubmit, handleInputChange} = this
            const {totalPlayers,ratePerPoint,winnerPointPerUnseen,winnerPointPerSeen,dubliWinnerPointPerSeen,dubliWinnerPointPerUnseen} = this.state
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Create New Marriage Game</div>
                            <div className="card-body ">
                                <form onSubmit={handleFormSubmit}>
                                    <div className="form-group">
                                        <label htmlFor="total_players">Number of Players(Max 6):</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            required
                                            onChange={(e)=>handleInputChange(e,totalPlayers)}
                                            value={totalPlayers}
                                            id="total_players"
                                            placeholder="Enter total number of players..."/>
                                    </div>

                                    <div className="form-group">
                                        <label htmlFor="rate_per_point">Rate Per Point:</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            required
                                            onChange={(e)=>handleInputChange(e,ratePerPoint)}
                                            value={ratePerPoint}
                                            id="rate_per_point"
                                            placeholder="Enter rate per point..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="winner_points_per_seen">Winner Points Per Seen:</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            required
                                            onChange={(e)=>handleInputChange(e,winnerPointPerSeen)}
                                            value={winnerPointPerSeen}
                                            id="winner_point_per_seen"
                                            placeholder="Enter winner point per seen..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="winner_points_per_unseen">Winner Points Per Unseen:</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            required
                                            onChange={(e)=>handleInputChange(e,winnerPointPerUnseen)}
                                            value={winnerPointPerUnseen}
                                            id="winner_point_per_unseen"
                                            placeholder="Enter winner point per unseen..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="dubli_winner_points_per_seen">Dubli Winner Points Per Seen</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            required
                                            onChange={(e)=>handleInputChange(e,dubliWinnerPointPerSeen)}
                                            value={dubliWinnerPointPerSeen}
                                            id="dubli_winner_point_per_seen"
                                            placeholder="Enter dubli winner point per seen..."/>
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="dubli_winner_points_per_unseen">Dubli Winner Points Per Unseen</label>
                                        <input
                                            type="text"
                                            className="form-control"
                                            required
                                            onChange={(e)=>handleInputChange(e,dubliWinnerPointPerUnseen)}
                                            value={dubliWinnerPointPerUnseen}
                                            id="dubli_winner_point_per_unseen"
                                            placeholder="Enter dubli point per unseen..."/>
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

