import React, {createContext, useReducer} from 'react';

const initialState = {
    users: [],
    selectedUsers: [],
};

const store = createContext(initialState);
const { Provider } = store;

const StateProvider = ( { children } ) => {
    const [state, dispatch] = useReducer((state, action) => {

        switch (action.type) {
            case 'get_state':
                return {
                    users: [...state.users],
                    selectedUsers: [...state.selectedUsers],
                };

            case 'update_data':
                console.log('updating searched users data');

                return {
                    users: action.payload,
                    selectedUsers: [...state.selectedUsers],
                };
            
            case 'update_selected_users':

                return {
                    users: [...state.users],
                    selectedUsers: [...state.selectedUsers, action.payload],
                };

            case 'set_selected_users':
                console.log('setting selectedUsers list by force');
                
                return {
                    users: [...state.users],
                    selectedUsers: action.payload,
                };

            default:
                throw new Error();
            };

    }, initialState);

    return <Provider value={{ state, dispatch }}>{children}</Provider>;
};

export { store, StateProvider }