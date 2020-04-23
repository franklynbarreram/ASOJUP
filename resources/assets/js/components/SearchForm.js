import React, { useContext, useEffect, useState, useRef } from 'react';
import axios from 'axios';

import Tabulator from 'tabulator-tables'; 
import 'tabulator-tables/dist/css/tabulator.min.css';

//Context??
import { store } from '../context';

//Custom Components
import UserTable from './UserTable';

const SearchForm = (props) => {
    
    const globalContext = useContext(store);
    const { state, dispatch } = globalContext;

    const tabulatorRef = useRef(null);

    const [searchValue, setSearchValue] = useState('');
    const [tabulator, setTabulator] = useState(null);

    const [picked, setPicked] = useState([]);

    useEffect(() => {
        setTabulator(initializeTable());
    },[]);

    useEffect(() => {console.log(state)}, [state]);

    const initializeTable = () => {

        const cols = [
            {
                formatter:"buttonCross", width:40, align:"center", cellClick: postDeleteItem
            },
            {title:"Nombre Completo", field:"fullname", width: 175},
            {title:"Cédula", field:"identification"},
            {title:"Teléfono", field:"phone_number"},
            {title:"Enfermedad", field:"disease"},
            {title:"Medicina", field:"medicine_name"},
            {title:"Presentación", field:"medicine_presentation"},
            {title:"Cantidad", field:"medicine_quantity", editor: "number", cellEdited: editQuantity},
            {title:"Medicine User Id", field:"user_medicine_id"}
        ];

        var tabulator = new Tabulator(tabulatorRef.current, {
            data: state.users,
            columns: cols,
            layout:"fitColumns",
        });

        let col = tabulator.getColumn('user_medicine_id');
        col.hide();

        // Setting initial data
        getExistentData(tabulator);

        return tabulator;
    }

    //-- Requests from component --//
    /**
     * Gets all the data related to diseases everytime enter key is pressed.
     */
    const getData = async () => {
        try {
            const url = 'http://localhost:8000/listings/search?listingId=1&disease=';

            const response = await axios.get(
                url + searchValue , {
                    headers: {
                        'Content-Type': 'application/json'
                    }
                }
            );

            const response_data = response.data;
            
            // Updating users data state
            dispatch({
                type: 'update_data',
                payload: response_data,
            });

            console.log(response_data);

        } catch (error) {
            throw error;
        }
    }

    /**
     * 
     * @param {tabulator} tabulator references the tabulator object used to list all the information.abs
     * 
     * Retrieves all the data related to the listing when the page is opened at 1st time.
     */
    const getExistentData = async (tabulator) => {
        const listId = 1;
        const url = 'http://localhost:8000/listings/current/' + listId;

        const response = await axios.get(
            url , {
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        );

        const response_data = response.data;
        
        tabulator.setData(response_data);

        // Stores the already selected items in case there is
        dispatch({
            type: 'set_selected_users',
            payload: response_data,
        });

        setPicked([...response_data]);
    }

    const postDeleteItem = async (e, cell) => {
        try {
            let row_data = cell.getRow().getData();

            const url = 'http://localhost:8000/listings/deleteItem';

            const response = await axios({
                method: 'delete',
                url: url,
                headers: {
                    'Content-Type': 'application/json'
                },
                data: {
                    listing_id: props.listingId,
                    inscribed_user_medicine_id: row_data.user_medicine_id,
                }
            });

            getData();

        } catch (error) {
            throw error;
        }
    }

    /**
     * 
     * @param {cell} cell References the cell object which is being edited at the moment.
     * 
     * This method is sends an update request to the row which is being updated, simulating a real time
     * updating via database. 
     */
    const editQuantity = async (cell) => {
        let row_data = cell.getRow().getData();

        const url = 'http://localhost:8000/listings/updateAmount';

        const response = await axios({
            method: 'put',
            url: url,
            headers: {
                'Content-Type': 'application/json'
            },
            data: {
                listing_id: 1,
                inscribed_user_medicine_id: row_data.user_medicine_id,
                amount: row_data.medicine_quantity
            }
        });
    }
    //-- End Requests from component --//
   
    //-- Other methods --//
    const handleChange = (e) => {       
        setSearchValue(e.target.value);
    }

    const enterPressed = (e) => {
        var code = e.keyCode || e.which;

        //Enter key code
        if (code === 13) {
            getData();
        } 
    }

    const selectData = (userData, tabulator) => {
        tabulator.addData([userData], true);

        // Update the selected users lists in state
        dispatch({
            type: 'update_selected_users',
            payload: userData,
        });

        setPicked([...picked, userData]);
    }

    return (
        <div>
            <div className="row inline-form mb-0">
                <div className="form-group col-12">
                    <input 
                        className="form-control" 
                        placeholder="Busca por enfermedad" 
                        type="text"
                        onChange={handleChange}
                        onKeyPress={enterPressed}
                    />
                </div>
            </div>

            <UserTable
                users={state.users} 
                selectDataFunction={selectData}
                tabulator={tabulator}
            />

            <h3>Listado:</h3>

            <div ref={tabulatorRef} />

            <small>Puedes actualizar la cantidad de la enfermedad, dando doble click en la casilla respectiva.</small>
        </div>
    );
}

export default SearchForm;