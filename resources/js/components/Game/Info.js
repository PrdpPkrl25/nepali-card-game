import React, { Component } from 'react';



export default class Point extends Component {
    constructor(props) {
        super(props);
        this.state = {
            game: '',
        }
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
                                                <td>{this.state.game['number_of_players']}</td>
                                            </tr>

                                            <tr>
                                                <td>2.</td>
                                                <td>Rate Per point</td>
                                                <td>{this.state.game['rate_per_point']}</td>
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

