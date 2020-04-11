import React, { Component } from 'react';

//Custom Components
import UserInfo from './UserInfo';

class UserTable extends Component {

    constructor(props) {
        super(props);
    }

    render () {
        return (
            <div>
                <h3>Usuarios Encontrados:</h3>
    
                {
                    this.props.users.map( user => 
                        <UserInfo key={user.id} user={user} />
                    )
                }
            </div>
        );
    }
}

export default UserTable;