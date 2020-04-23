import React, { Component } from 'react';

// Components
import SearchForm from './SearchForm';
import Listing from './Listing';

import {StateProvider} from '../context';

class Bar extends Component {

    constructor(props) {
        super(props);
    }
    
    render() {
        return (
            <StateProvider>
                <Listing listingId={this.props.listingId} />
            </StateProvider>
        );
    }
}

export default Bar;