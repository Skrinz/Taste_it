import React, {useState} from "react";
import '../Styles/ManageAccount.css';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faMapMarkerAlt, faCheck, faFlag, faEnvelope, faMobileAlt } from "@fortawesome/free-solid-svg-icons";
import SelectInput from "./SelectInput";
import NumberInput from "./NumberInput";
 
function ManageAccount(){

    const countries = [
        "Afghanistan", "Albania", "Algeria", "Andorra", "Angola", "Antigua and Barbuda", 
        "Argentina", "Armenia", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", 
        "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bhutan", 
        "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", 
        "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", 
        "Central African Republic", "Chad", "Chile", "China", "Colombia", "Comoros", 
        "Congo (Congo-Brazzaville)", "Costa Rica", "Croatia", "Cuba", "Cyprus", 
        "Czech Republic (Czechia)", "Democratic Republic of the Congo", "Denmark", 
        "Djibouti", "Dominica", "Dominican Republic", "East Timor (Timor-Leste)", "Ecuador", 
        "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini (fmr. Swaziland)", 
        "Ethiopia", "Fiji", "Finland", "France", "Gabon", "Gambia", "Georgia", 
        "Germany", "Ghana", "Greece", "Grenada", "Guatemala", "Guinea", "Guinea-Bissau", 
        "Guyana", "Haiti", "Honduras", "Hungary", "Iceland", "India", "Indonesia", 
        "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", 
        "Kazakhstan", "Kenya", "Kiribati", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", 
        "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", 
        "Luxembourg", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", 
        "Marshall Islands", "Mauritania", "Mauritius", "Mexico", "Micronesia", "Moldova", 
        "Monaco", "Mongolia", "Montenegro", "Morocco", "Mozambique", "Myanmar (Burma)", 
        "Namibia", "Nauru", "Nepal", "Netherlands", "New Zealand", "Nicaragua", "Niger", 
        "Nigeria", "North Korea", "North Macedonia", "Norway", "Oman", "Pakistan", 
        "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", 
        "Poland", "Portugal", "Qatar", "Romania", "Russia", "Rwanda", "Saint Kitts and Nevis", 
        "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", 
        "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", 
        "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", 
        "South Africa", "South Korea", "South Sudan", "Spain", "Sri Lanka", "Sudan", 
        "Suriname", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", 
        "Thailand", "Togo", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", 
        "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", 
        "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", 
        "Vatican City", "Venezuela", "Vietnam", "Yemen", "Zambia", "Zimbabwe"
    ];

    const philippineRegions = [
        "REGION 7 - CENTRAL VISAYAS",
        "NCR - NATIONAL CAPITAL REGION",
        "REGION 8 - EASTERN VISAYAS",
        "REGION 9 - ZAMBOANGA PENINSULA",
        "REGION 10 - NORTHERN MINDANAO",
        "CAR - CORDILLERA ADMINISTRATIVE REGION",
        "REGION 1 - ILOCOS REGION",
        "REGION 2 - CAGAYAN VALLEY",
        "REGION 3 - CENTRAL LUZON",
        "REGION 4-A - CALABARZON",
        "REGION 4-B - MIMAROPA",
        "REGION 5 - BICOL REGION",
        "REGION 6 - WESTERN VISAYAS",
        "REGION 11 - DAVAO REGION",
        "REGION 12 - SOCCSKARGEN",
        "REGION 13 - CARAGA",
        "ARMM - AUTONOMOUS REGION IN MUSLIM MINDANAO",
        "NONE - NONE",
        "REGION X",
        "NONE"
    ]; 

    const provinces = [
        "Abra",
        "Agusan del Norte",
        "Agusan del Sur",
        "Aklan",
        "Albay",
        "Antique",
        "Apayao",
        "Aurora",
        "Batangas",
        "Benguet",
        "Bataan",
        "Batanes",
        "Biliran",
        "Boho",
        "Bukidnon",
        "Bulacan",
        "Cagayan",
        "Camarines Norte",
        "Camarines Sur",
        "Camiguin",
        "Capiz",
        "Catanduanes",
        "Cavite",
        "Cebu",
        "Chocolate Hills",
        "Compostela Valley",
        "Davao del Norte",
        "Davao del Sur",
        "Davao Oriental",
        "Eastern Samar",
        "Guimaras",
        "Ifugao",
        "Ilocos Norte",
        "Ilocos Sur",
        "Iloilo",
        "Isabela",
        "Kalinga",
        "La Union",
        "Laguna",
        "Lanao del Norte",
        "Lanao del Sur",
        "Leyte",
        "Maguindanao",
        "Marinduque",
        "Masbate",
        "Misamis Occidental",
        "Misamis Oriental",
        "Mountain Province",
        "Negros Occidental",
        "Negros Oriental",
        "Northern Samar",
        "Nueva Ecija",
        "Nueva Vizcaya",
        "Occidental Mindoro",
        "Oriental Mindoro",
        "Palawan",
        "Pampanga",
        "Pangasinan",
        "Quezon",
        "Quirino",
        "Rizal",
        "Romblon",
        "Samar",
        "Sarangani",
        "Siquijor",
        "Sorsogon",
        "South Cotabato",
        "Southern Leyte",
        "Sultan Kudarat",
        "Sulu",
        "Surigao del Norte",
        "Surigao del Sur",
        "Tarlac",
        "Tawi-Tawi",
        "Zambales",
        "Zamboanga del Norte",
        "Zamboanga del Sur",
        "Zamboanga Sibugay"
    ];


    const cities = [
        "Cebu City",
        "Mandaue City",
        "Lapu-Lapu City",
        "Talisay City",
        "Toledo City",
        "Danao City",
        "Carcar City",
        "Naga City",
        "Bogo City",
        "Sogod",
        "Balamban",
        "Moalboal",
        "Barili",
        "Catmon",
        "Carmen",
        "San Fernando",
        "Cordova",
        "Alegria",
        "Argao",
        "Bantayan",
        "Tabogon",
        "Liloan",
        "Minglanilla",
        "Consolacion",
        "Poro",
        "San Francisco",
        "Tudela",
        "Aloguinsan",
        "Bogo",
        "Borbon",
        "Carmen",
        "Dumanjug",
        "Ginatilan",
        "Lazi",
        "Malabuyoc",
        "Moalboal",
        "Ronda",
        "Samboan",
        "Santander",
        "Sierra Bullones",
        "Tabuelan",
        "Talisay",
        "Taytay",
        "Valencia",
        "Villaconzoilo"
    ];

    const num = [
        "Mobile Number",
        "Telephone Number",
        "Fax",
        "Others"
    ];


    const [userForm, setUserForm] = useState({});
    const [formData, setFormData] = useState(null);

    const handleChanges = (e) =>{
        const {name, value} = e.target;

        setUserForm({
            ...userForm,
            [name]: value,
        });
    }

    const handleSubmit = (e) => {
        e.preventDefault(); 
        setFormData(userForm); 
    }

    return(
        <section className="form-container">
            <div className="form-main">
                <div className="form-header">
                    <i className='fa fa-pencil'/>
                    <label>MANAGE ACCOUNT</label>
                </div>

                <div className="horizontalsep"></div>
            
                <form onSubmit={handleSubmit}>
                    {/* section 1 */}
                    <div className="section1">
                        <div className="input-container">
                            <label>Email Address</label>
                            <div className="input-wrapper">
                                <FontAwesomeIcon icon={faEnvelope} className="icons"/>
                                <input type="email" id="email" name="email" className="input-field type1" placeholder="Enter your email" onChange={handleChanges}/>
                            </div>
                        </div>
                        
                        {/* Permanent Address Country */}
                        <SelectInput
                            label="Permanent Address Country"
                            icon={faFlag}
                            options={countries}
                            name="permanentCountry"
                            placeholder="Please select country."
                            handleChange={handleChanges}
                        />

                        {/* Permanent Address Region */}
                        <SelectInput
                            label="Permanent Address Region"
                            icon={faMapMarkerAlt}
                            options={philippineRegions}
                            name="permanentRegion"
                            placeholder="Please select region."
                            handleChange={handleChanges}
                        />
                    </div>

                    {/* section 2 */}
                    <div className="section2">
                        {/* Permanent Address Province */}
                        <SelectInput
                            label="Permanent Address Province"
                            icon={faMapMarkerAlt}
                            options={provinces}
                            name="permanentProvince"
                            placeholder="Please select province."
                            handleChange={handleChanges}
                        />

                        {/* Permanent Address City */}
                        <SelectInput
                            label="Permanent Address City"
                            icon={faMapMarkerAlt}
                            options={cities}
                            name="permanentCity"
                            placeholder="Please select city."
                            handleChange={handleChanges}
                        />
                    </div>

                    {/* section 3 */}
                    <div className="section3">
                        <div className="input-container">
                            <label>House No./Street/Barangay</label>
                            <div className="input-wrapper">
                                <FontAwesomeIcon icon={faMapMarkerAlt} className="icons"/>
                                <input type="text" name="permanentAddress" className="input-field type4" placeholder="House No./Street/Barangay" onChange={handleChanges}/>
                            </div>
                        </div>
                    </div>

                    {/* section 4 */}
                    <div className="section4">
                         {/* Present Address Country */}
                         <SelectInput
                            label="Present Address Country"
                            icon={faFlag}
                            options={countries}
                            name="presentCountry"
                            placeholder="Please select country."
                            handleChange={handleChanges}
                        />

                        {/* Present Address Region */}
                        <SelectInput
                            label="Present Address Region"
                            icon={faMapMarkerAlt}
                            options={philippineRegions}
                            name="presentRegion"
                            placeholder="Please select region."
                            handleChange={handleChanges}
                        />

                        {/* Present Address Province */}
                        <SelectInput
                            label="Present Address Province"
                            icon={faMapMarkerAlt}
                            options={provinces}
                            name="presentProvince"
                            placeholder="Please select province."
                            handleChange={handleChanges}
                        />

                        {/* Present Address City */}
                        <SelectInput
                            label="Present Address City"
                            icon={faMapMarkerAlt}
                            options={cities}
                            name="presentCity"
                            placeholder="Please select city."
                            handleChange={handleChanges}
                        />
                    </div>

                    {/* section 5 */}
                    <div className="section5">
                        <div className="input-container">
                            <label>House No./Street/Barangay</label>
                            <div className="input-wrapper">
                                <FontAwesomeIcon icon={faMapMarkerAlt} className="icons"/>
                                <input type="text" name="presentAddress" className="input-field type3" placeholder="House No./Street/Barangay" onChange={handleChanges}/>
                            </div>
                        </div>

                        {/* Select Number Type */}
                        <NumberInput
                            label="Number Type"
                            icon={faFlag}
                            options={num}
                            name="numtype1"
                            placeholder="Please select type of number."
                            handleChange={handleChanges}
                        />

                        <div className="input-container">
                            <label>Contact Number</label>
                            <div className="input-wrapper">
                                <FontAwesomeIcon icon={faMobileAlt} className="icons"/>
                                <input type="number"  name="num1" className="input-field type3" placeholder="Contact Number" onChange={handleChanges} />
                            </div>
                        </div>

                        {/* Select Number Type */}
                        <NumberInput
                            label="Number Type"
                            icon={faFlag}
                            options={num}
                            name="numtype2"
                            placeholder="Please select type of number."
                            handleChange={handleChanges}
                        />

                        <div className="input-container">
                            <label>Contact Number</label>
                            <div className="input-wrapper">
                                <FontAwesomeIcon icon={faMobileAlt} className="icons"/>
                                <input type="number"  name="num2" className="input-field type3" placeholder="Contact Number" onChange={handleChanges} />
                            </div>
                        </div>

                        {/* Select Number Type */}
                        <NumberInput
                            label="Number Type"
                            icon={faFlag}
                            options={num}
                            name="numtype3"
                            placeholder="Please select type of number."
                            handleChange={handleChanges}
                        />

                        <div className="input-container">
                            <label>Contact Number</label>
                            <div className="input-wrapper">
                                <FontAwesomeIcon icon={faMobileAlt} className="icons"/>
                                <input type="number"  name="num3" className="input-field type3" placeholder="Contact Number" onChange={handleChanges} />
                            </div>
                        </div>
                    </div>  

                    <div className="horizontalsep"></div>

                    <div className="form-footer">
                        <button type="submit" className="saveBtn"><FontAwesomeIcon icon={faCheck} className="footer-icon"/>Save changes</button> 
                    </div>
                </form>

                {formData && (
                    <div >
                        <h3>Form Data:</h3>
                        <pre>{JSON.stringify(formData, null, 2)}</pre>
                    </div>
                )}
            </div>
        </section>
    );
}

export  default ManageAccount