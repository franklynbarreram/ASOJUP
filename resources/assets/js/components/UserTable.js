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
                {
                    this.props.users.map( user => 
                        <UserInfo 
                            key={user.id} 
                            user={user}
                            selectDataFunction={this.props.selectDataFunction}
                        />
                    )
                }
            </div>
        );
    }
}

export default UserTable;