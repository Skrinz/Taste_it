import React from "react";
import {useNavigate} from 'react-router-dom';


function Landing(){
    const navigate = useNavigate();

    const handleSubmit = (e) => {
        e.preventDefault();
        navigate("/login");
    }
    return(
        <form onSubmit={handleSubmit}>
            This is Landing Page
            <button type="submit">Login</button>
        </form>
    );

}

export default Landing;