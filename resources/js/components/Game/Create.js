import React, { Component } from 'react';
import axios from 'axios';
import toastr from 'cogo-toast';



export default class Create extends Component {
        state = {
            input:{
                number_of_players:'4',
                rate_per_point:'1',
                winner_points_per_seen:'3',
                winner_points_per_unseen:'10',
                dubli_winner_points_per_seen:'5',
                dubli_winner_points_per_unseen:'10'
            },
            error:[]
        };


    handleInputChange=(event)=>{
        let input=this.state.input
        input[event.target.name]=event.target.value
       this.setState({
           input
       })
    };

    hasErrorFor=(fieldName)=>
    {
        return !!this.state.errors[fieldName];
    }

    renderErrorFor=(fieldName)=>
    {
        if (this.hasErrorFor(fieldName)) {
            return (
                <em className="error invalid-feedback"> {this.state.errors[fieldName][0]} </em>
            )
        }
    }


    handleFormSubmit=(event)=>{
        event.preventDefault();
            const {input} = this.state;
            axios.post('/api/games',input).then(response=>{
                this.setState({
                    input:{}
                })
                this.props.history.push(`/add-players/${response.data['id']}`,response.data);
            }).catch(error => {
              toastr.error(error.response.data.errors.number_of_players, {position : 'top-right', heading: 'Error'});
                this.setState({
                    errors : error.response.data.errors
                })
            })
    };

    render(){
            const {handleFormSubmit, handleInputChange,renderErrorFor} = this
            const {input} = this.state
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-10">
                        <div className="card mt-5" >
                            <div className="card-header">Create New Marriage Game</div>
                            <div className="card-body ">
                                <form onSubmit={handleFormSubmit}>

                                    <div className="form-group row mt-2 text-center">
                                        <label
                                            className="col-md-5 col-form-label text-md-right mr-5"
                                            htmlFor="number_of_players">
                                            Number of Players(Max 6):
                                        </label>
                                        <input
                                            type="text"
                                            className={`form-control col-md-4 text-center`}
                                            name="number_of_players"
                                            onChange={handleInputChange}
                                            value={input.number_of_players||''}
                                            id="number_of_players"
                                            placeholder="Enter total number of players..."/>
                                    </div>

                                    <div className="form-group row mt-2 text-center">
                                        <label
                                            className="col-md-5 col-form-label text-md-right mr-5"
                                            htmlFor="rate_per_point">
                                            Rate Per Point:
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control col-md-4 text-center"
                                            name="rate_per_point"
                                            onChange={handleInputChange}
                                            value={input.rate_per_point||''}
                                            id="rate_per_point"
                                            placeholder="Enter rate per point..."/>
                                    </div>

                                    <div className="form-group row mt-2 text-center">
                                        <label
                                            className="col-md-5 col-form-label text-md-right mr-5"
                                            htmlFor="winner_points_per_seen">
                                            Winner Points Per Seen:
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control col-md-4 text-center"
                                            name="winner_points_per_seen"
                                            onChange={handleInputChange}
                                            value={input.winner_points_per_seen||''}
                                            id="winner_points_per_seen"
                                            placeholder="Enter winner point per seen..."/>
                                    </div>
                                    <div className="form-group row mt-2 text-center">
                                        <label
                                            className="col-md-5 col-form-label text-md-right mr-5"
                                            htmlFor="winner_points_per_unseen">
                                            Winner Points Per Unseen:
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control col-md-4 text-center"
                                            name="winner_points_per_unseen"
                                            onChange={handleInputChange}
                                            value={input.winner_points_per_unseen||''}
                                            id="winner_points_per_unseen"
                                            placeholder="Enter winner point per unseen..."/>
                                    </div>
                                    <div className="form-group row mt-2 text-center">
                                        <label
                                            className="col-md-5 col-form-label text-md-right mr-5"
                                            htmlFor="dubli_winner_points_per_seen">
                                            Dubli Winner Points Per Seen
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control col-md-4 text-center"
                                            name="dubli_winner_points_per_seen"
                                            onChange={handleInputChange}
                                            value={input.dubli_winner_points_per_seen||''}
                                            id="dubli_winner_points_per_seen"
                                            placeholder="Enter dubli winner point per seen..."/>
                                    </div>
                                    <div className="form-group row mt-2 text-center">
                                        <label
                                            className="col-md-5 col-form-label text-md-right mr-5"
                                            htmlFor="dubli_winner_points_per_unseen">
                                            Dubli Winner Points Per Unseen
                                        </label>
                                        <input
                                            type="text"
                                            className="form-control col-md-4 text-center"
                                            name="dubli_winner_points_per_unseen"
                                            onChange={handleInputChange}
                                            value={input.dubli_winner_points_per_unseen||''}
                                            id="dubli_winner_points_per_unseen"
                                            placeholder="Enter dubli point per unseen..."/>
                                    </div>
                                    <div className="col-md-3 offset-md-5 text-center">
                                    <button type="submit" className="btn btn-primary">Submit</button>
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

