import React, { Component } from 'react';
import axios from "axios";



export default class Point extends Component {
    constructor(props) {
        super(props);
        this.state = {
            game: '',
        }
    }

    componentDidMount(){
        const gameId=this.props.match.params.gameId;
        axios.get(`/api/games/${gameId}`).then(response=>{
            console.log(response.data)
            this.setState({
                game:response.data
            })
        })

    }


    render(){
        const {game}=this.state
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header"> Game Info</div>
                            <div className="card-body ">
                                <table className="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">S.N</th>
                                        <th scope="col">Attribute</th>
                                        <th scope="col">Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>1.</td>
                                                <td>Number of Players</td>
                                                <td>{game['number_of_players']}</td>
                                            </tr>

                                            <tr>
                                                <td>2.</td>
                                                <td>Rate Per point</td>
                                                <td>{game['rate_per_point']}</td>
                                            </tr>
                                            <tr>
                                                <td>3.</td>
                                                <td>Winner Points Per Seen</td>
                                                <td>{game['winner_points_per_seen']}</td>
                                            </tr>
                                            <tr>
                                                <td>4.</td>
                                                <td>Winner Points Per Unseen</td>
                                                <td>{game['winner_points_per_unseen']}</td>
                                            </tr>
                                            <tr>
                                                <td>5.</td>
                                                <td>Dubli Winner Points Per Seen</td>
                                                <td>{game['dubli_winner_points_per_seen']}</td>
                                            </tr>
                                            <tr>
                                                <td>6.</td>
                                                <td>Dubli Winner Points Per Unseen</td>
                                                <td>{game['dubli_winner_points_per_unseen']}</td>
                                            </tr>
                                            <tr>
                                                <td>7.</td>
                                                <td>View Token Id</td>
                                                <td>{game['view_token_id']}</td>
                                            </tr>
                                            <tr>
                                                <td>8.</td>
                                                <td>Edit Token Id</td>
                                                <td>{game['edit_token_id']}</td>
                                            </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

