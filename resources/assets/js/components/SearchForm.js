import React, { Component } from 'react';
import axios from 'axios';

//Custom Components

import UserTable from './UserTable';

class SearchForm extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isOpened: true,
            loading: null,
            error: null,
            data: {
                results: [],
            },
            searchValue: '',
        };
    }

    async getData () {
        this.setState({ loading: true, error: null })

        try {
            const response = await axios.get(
                'http://localhost:8000/listings/search?disease=' + this.state.searchValue , {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );

            const response_data = response.data;

            this.setState({
                loading: false,
                data: {
                    results: response_data
                }
            })

            console.log(this.state.data);

        } catch (error) {
            this.setState({ loading: false, data: null, error: error });

            console.log(error);
        }
    }

    componentDidMount () {
        console.log('Component mounted!');
    }

    handleOpened = (e) => {
        this.setState({
            isOpened: !this.state.isOpened
        });

        console.log(this.state.isOpened);
    }

    handleChange = (e) => {
        this.setState({
            searchValue: e.target.value
        });

        console.log(this.state.searchValue);
    }

    enterPressed = (e) => {
        var code = e.keyCode || e.which;
        
        if (code === 13) { //13 is the enter keycode
            this.getData();
        } 
    }

    render () {
        return (
            <div>
                <div className="row inline-form mb-0">
                    <div className="form-group col-12">
                        <input 
                            className="form-control" 
                            placeholder="Busca por enfermedad" 
                            type="text"
                            onChange={this.handleChange}
                            onKeyPress={this.enterPressed}
                        />
                    </div>
                </div>

                <UserTable users={this.state.data.results} />
            </div>
        );
    }
}

export default SearchForm;