import React, { Component } from 'react';
import axios from 'axios';

// Custom CSS
import '../../css/user-info.css';

class MedicineInfo extends Component {

    constructor(props) {
        super(props);

        this.state = {
            isSelected: this.props.medicine.selected,
        }
    }

    handleClick = (medicine) => {

        let med_obj = {
            fullname: this.props.user.name + ' ' + this.props.user.surname,
            identification: this.props.user.identification,
            phone_number: this.props.user.phone,
            disease: this.props.user.disease_name,
            medicine_name: medicine.name,
            medicine_presentation: medicine.pres + ' ' + medicine.spec,
            medicine_quantity: 1,
            user_medicine_id: medicine.user_medicine_id
        };

        this.props.selectDataFunction(med_obj);

        this.postPickItem(medicine);

        this.setState({
            isSelected: !this.state.isSelected
        });
    }

    getButton = (medicine) => {
        if (!this.state.isSelected) {
            return (
                <span className="linkable" onClick={() => this.handleClick(medicine)}>
                    Agregar al listado
                </span>
            );
        } else {
            return (
                <span className="added">
                    Agregado
                </span>
            );
        }
    }

    /**
     * Adds the medicine to the listing in database via post request.
     */
    postPickItem = async (medicine) => {
        try {
            const response = await axios.post(
                'http://localhost:8000/listings/pickItem', {
                    inscribed_user_medicine_id : medicine.user_medicine_id,
                    listing_id: 1
                }
            );

        } catch (error) {
            console.log(error);
        }
    }

    render () {
        return (
            <div key={this.props.medicine.id} className="row medicines-row text-center">
                                
                <div className="col">
                    {this.props.medicine.name}
                </div>

                <div className="col">
                    {this.props.medicine.pres}
                </div>

                <div className="col">
                    {this.props.medicine.spec}
                </div>

                <div className="col">
                    {this.getButton(this.props.medicine)}
                </div>
            </div>
        );
    }
}

export default MedicineInfo;