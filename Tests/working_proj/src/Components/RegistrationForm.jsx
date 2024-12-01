import React, {useState} from "react";
 
function RegistrationForm(){
    const [userForm, setUserForm] = useState({});

    const handleChanges = (e) =>{
        const {name, value} = e.target;

        setUserForm({
            ...userForm,
            [name]: value,
        });
        console.log(name);
        console.log(value);
    }

    return(
        <section>
            <label>Register an Account</label>
            <br/>
            <form>
                <input
                    type="number"
                    id="idNum"
                    name="idNum"
                    placeholder="ID Number"
                    value={userForm.idNum}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="text"
                    id="firstName"
                    name="firstName"
                    placeholder="First Name"
                    value={userForm.firstName}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="text"
                    id="lastName"
                    name="lastName"
                    placeholder="Last Name"
                    value={userForm.lastName}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="text"
                    id="city"
                    name="city"
                    placeholder="City"
                    value={userForm.city}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="text"
                    id="region"
                    name="region"
                    placeholder="Region"
                    value={userForm.region}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="number"
                    id="phonenum"
                    name="phonenum"
                    placeholder="Phone Number"
                    value={userForm.phonenum}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="number"
                    id="telenum"
                    name="telenum"
                    placeholder="Telephone Number"
                    value={userForm.phonenum}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="date"
                    id="bod"
                    name="bod"
                    placeholder="Birthdate"
                    value={userForm.bod}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    value={userForm.password}
                    onChange={handleChanges}
                />
                <br/>

                <input
                    type="password"
                    id="cpassword"
                    name="cpassword"
                    placeholder="Confirm Password"
                    value={userForm.cpassword}
                    onChange={handleChanges}
                />
                <br/>
                <button>Register</button>
            </form>
        </section>
    );
}

export  default RegistrationForm