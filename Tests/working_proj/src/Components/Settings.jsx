import React from 'react';
import {useNavigate} from 'react-router-dom';

function Settings(){
    const navigate = useNavigate();

    const handleClick = (e) => {
        e.preventDefault();
        const name = e.target.name;
        if(name === 'manageaccount'){
            navigate("/manageaccount");
        }else if(name === 'login'){
            navigate("/login");
        }
        
    }

    return(
        <div>
            This is Settings
            <button type="submit" onClick={handleClick} name='manageaccount'>Manage Account</button>
            <button type='submit' onClick={handleClick} name='login'>Login</button>
        </div>
    );
}

export default Settings;