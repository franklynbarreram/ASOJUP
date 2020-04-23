import React, { Component } from 'react';

export default class DeleteRenderer extends Component {
    constructor(props) {
        super(props);
    }

    render() {

        const styles = {
            position: "relative",
            top: "12px",
            left: "-5px",
            color: "#f70d0d"
        };

        return <i style={styles} className="fas fa-trash"></i>;
    }
}