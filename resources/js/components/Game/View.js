import React, { Component } from 'react';
import axios from 'axios';
import {toast} from "react-toastify";


export default class Add extends Component {

    state={
       code:''
    }



    handleInput=(event)=>{
        this.setState({
            code:event.target.value
        })
    }


    handleSubmit=(event)=>{
        const {code}=this.state
        event.preventDefault();
        axios.post("/api/view/points-table",{
            code:code,
        }).then(response=>{
            toast(response.data['error'],{
                position:"top-center",
                autoClose:3000,
            })
            this.setState({
                code:'',
            })
            if (response.data['gameId']){
                this.props.history.push(`/points/table/${response.data['gameId']}`);
            }
        }).catch(err=>console.log(err));

    }



    render(){
        const {handleInput,handleSubmit}=this
        const {code}=this.state
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-12">
                        <div className="card mt-5" >
                            <div className="card-header">Enter code to view/edit your game</div>
                            <div className="card-body ">
                                <form onSubmit={handleSubmit}>
                                    <div className="form-group row mt-2 text-center">
                                        <label className="col-md-5 col-form-label text-md-right" htmlFor="player_name">Your Code:</label>
                                        <input type="text"  className="form-control col-md-3" value={code}  onChange={handleInput}  id="code" placeholder="Enter your code..."/>
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

