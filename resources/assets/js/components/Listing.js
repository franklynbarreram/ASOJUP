import React, { Component } from 'react';
import axios from 'axios';

// AG-Grid
import { AgGridReact } from 'ag-grid-react';

// Styles
import 'ag-grid-community/dist/styles/ag-grid.css';
import 'ag-grid-community/dist/styles/ag-theme-balham.css';
import 'ag-grid-community/dist/styles/ag-theme-alpine.css';

// Custom Components
import UserTable from './UserTable';

// Renderers
import DeleteRenderer from './renderers/delete.jsx';

class Listing extends Component {

    state = {    
        loading: true,
        error: null,
        searchValue: '',
        currentUsers: [],
        selectedUsers: []
    }

    constructor (props) {
        super(props);

        // Table default column definitions
        this.defaultColDef = {
            resizable: true
        };

        // Table custom frameworks components
        this.frameworkComponents = {
            'deleteRenderer': DeleteRenderer
        };
        
        // Table custom column definitions
        this.columnDefs = [
            {
                headerName: '',
                field: 'delete_opc',
                cellRenderer: 'deleteRenderer',
                width: 10,
                onCellClicked: (params) => {
                    let row_data = params.data;

                    this.postDeleteItem(row_data);
                }
            },
            { headerName: 'Nombre Completo', field: 'fullname' },
            { headerName: 'Cédula', field: 'identification', width: 120},
            { headerName: 'Teléfono', field: 'phone_number', width: 135 },
            { headerName: 'Enfermedad', field: 'disease', width: 170 },
            { headerName: 'Medicina', field: 'medicine_name', width: 170 },
            { headerName: 'Presentación', field: 'medicine_presentation', width: 165 },
            {
                //Editable medicine amount column
                headerName: 'Cant',
                field: 'medicine_quantity',
                editable: true,
                width: 50,
                onCellValueChanged: (params) => {
                    let row_data = params.data;
                    
                    this.editQuantity(row_data);
                }
            }, 
            {   
                //Hidden medicine user id column 
                headerName: 'Medicine User Id',
                field: 'user_medicine_id',
                hide: true
            },
        ];

    }

    componentDidMount () {
        console.log('Component mounted!');

        this.getExistentData();
    }

    /**Functions related to the input variation */
    handleChange = (e) => {
        this.setState({ searchValue: e.target.value});
    }

    enterPressed = (e) => {
        var code = e.keyCode || e.which;

        //Enter key code
        if (code === 13) {
            this.getData();
        } 
    }

    selectData = (userData) => {
        this.setState({
            selectedUsers: [...this.state.selectedUsers, userData]
        })
    }
    // --- End

    // --------------------- Requests functions -----------------------
    /**
     * Gets all the data related to diseases everytime enter key is pressed.
     */
    getData = async () => {
        try {
            this.setState({ loading: true, error: null });

            const url = 'http://localhost:8000/listings/search?listingId=' + this.props.listingId + '&disease=' + this.state.searchValue;

            const response = await axios.get(
                url , {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );

            const response_data = response.data;
            
            // Updating users data state
            this.setState({
                loading: false,
                currentUsers: [].concat(this.state.currentUsers, response_data)
            });

            //console.log(this.state);

        } catch (error) {
            this.setState({ error: error, loading: false })
        }
    }

    /**
     * Gets the initial data related to the users that has been selected.
     */
    getExistentData = async () => {
        try {

            this.setState({ loading: true, error: null });

            const url = 'http://localhost:8000/listings/current/' + this.props.listingId;

            const response = await axios.get(
                url , {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );
    
            const response_data = response.data;
            
            this.setState({
                loading: false,
                selectedUsers: [].concat(this.state.selectedUsers, response_data)
            });

        } catch (error) {
            this.setState({ error: error, loading: false })
        }
    }

    /**
     * Delete a selected item from the list. By clicking red trash icon.
     */
    postDeleteItem = async (row_data) => {
        try {
            const url = 'http://localhost:8000/listings/deleteItem';

            const response = await axios({
                method: 'delete',
                url: url,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: {
                    listing_id: this.props.listingId,
                    inscribed_user_medicine_id: row_data.user_medicine_id,
                }
            });
            
            const updSelUsers = this.state.selectedUsers.filter(usr => {
                return usr.user_medicine_id !== row_data.user_medicine_id;
            });

            this.setState({
                selectedUsers: updSelUsers
            });

            const selUsers = this.state.currentUsers;

            selUsers.forEach(usr => {
                usr.medicines.forEach(med => {
                    if (med.user_medicine_id === row_data.user_medicine_id) {
                        med.selected = 0;
                    }
                });
            });

            this.setState({
                selectedUsers : selUsers
            });

        } catch (error) {
            throw error;
        }
    }

    /**
     * Editing quantity
     */
    editQuantity = async (row_data) => {
        const url = 'http://localhost:8000/listings/updateAmount';

        const response = await axios({
            method: 'put',
            url: url,
            headers: {
                'Content-Type': 'application/json'
            },
            data: {
                listing_id: this.props.listingId,
                inscribed_user_medicine_id: row_data.user_medicine_id,
                amount: row_data.medicine_quantity
            }
        });
    }

    // Rendering component
    render () {
        return (
            <div>
                <div className="row inline-form mb-0">
                    <div className="form-group col-12">
                        <input 
                            className="form-control" 
                            placeholder="Busca usuarios por enfermedad" 
                            type="text"
                            onChange={this.handleChange}
                            onKeyPress={this.enterPressed}
                        />
                    </div>
                </div>

                <h3>Usuarios Encontrados:</h3>

                {
                    this.state.currentUsers.length == 0  ?
                        <h3 className="text-center">No se han encontrado usuarios</h3> 
                    :                        
                        <UserTable
                            users={this.state.currentUsers} 
                            selectDataFunction={this.selectData}
                        />
                }

                <h3>Listado de Usuarios: </h3>

                <div className="ag-theme-alpine" style={{height: '350px'}}>
                    <AgGridReact
                        columnDefs={this.columnDefs}
                        defaultColDef={this.defaultColDef}
                        rowData={this.state.selectedUsers}
                        frameworkComponents={this.frameworkComponents}
                    >
                    </AgGridReact>
                </div>
            </div>
        );
    }
}

export default Listing;