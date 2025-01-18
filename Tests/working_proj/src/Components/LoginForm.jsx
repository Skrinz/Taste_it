import React, {useState} from "react";
import '../Styles/Login.css';
import {useNavigate} from 'react-router-dom';
 
function LoginForm(){
    const [userForm, setUserForm] = useState({});
    const navigate = useNavigate();

    const handleChanges = (e) =>{
        const {name, value} = e.target;

        setUserForm({
            ...userForm,
            [name]: value,
        });
        console.log(name);
        console.log(value);
    }

    const handleSubmit = (e) =>{
        e.preventDefault();
        navigate("/dashboard");
    }

    return(
        <section className="loginForm">
            <div className="loginHeader">
                <i className='fa fa-shield'/>
                <label>Login to your account</label>
            </div>
        
            <form onSubmit={handleSubmit}>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Username"
                    value={userForm.username}
                    onChange={handleChanges}
                />
                
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    value={userForm.password}
                    onChange={handleChanges}
                />
                <button type="submit" className="loginBtn">Login</button>
            </form>
        </section>
    );
}

export  default LoginForm