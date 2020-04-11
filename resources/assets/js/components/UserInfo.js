import React, { Component } from 'react';
import { Collapse } from 'react-collapse';

//Custom CSS
import '../../css/user-info.css';

class UserInfo extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isOpened: false
        }
    }

    handleIsOpened = () => {
        this.setState({
            isOpened: !this.state.isOpened
        });
    }

    render () {
        return (
            <div className="user-row">
                <div className={"row text-center" + (this.state.isOpened == true ? ' spaced' : '')}>
                    <div className="col">{this.props.user.name}</div>
                    <div className="col">{this.props.user.surname}</div>
                    <div className="col">{this.props.user.identification}</div>
                    <div className="col">{this.props.user.phone}</div>

                    <div className="col">
                        <span className="linkable" onClick={this.handleIsOpened} href="#">Ver Medicamentos</span>
                    </div>
                </div>

                <Collapse isOpened={this.state.isOpened} className="collapse">
                    {
                        this.props.user.medicines.map( medicine => 
                            <div key={medicine.id} className="row medicines-row text-center">
                                <div className="col">
                                    {medicine.name}
                                </div>
                                <div className="col">
                                    {medicine.pres}
                                </div>
                                <div className="col">
                                    {medicine.spec}
                                </div>
                                <div className="col">
                                    Agregar al listado
                                </div>
                            </div>
                        )
                    }
                </Collapse>
            </div>
        );
    }
}

export default UserInfo;