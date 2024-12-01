import React from 'react';
import '../Styles/Header.css'; 
import uscLogo from '../assets/images/uscLogo-removebg-preview.png';
import radenPic from '../assets/images/raden.png';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faGlobeAmericas, faBan } from '@fortawesome/free-solid-svg-icons';
import {useNavigate} from 'react-router-dom';


function Header(){

  const navigate = useNavigate();

  const handleClick = (e) =>{
    e.preventDefault();
    navigate("/settings");
  }

  return (
    <header className="header">

      
      <div className="header-content">
        <div className="left-section">
          <img src={uscLogo} alt="USC logo" className="logo" />
        </div>

        <div className="right-section">
          <FontAwesomeIcon icon={faGlobeAmericas}  className="icon" />
          <FontAwesomeIcon icon={faBan}  className="icon" flip='horizontal' />
          <div className='verticalsep'></div>
          <img src={radenPic} alt="User profile" className="profile-pic" onClick={handleClick} />
          <p className="user-id">11700024</p>
        </div>
      </div>
    </header>
  );
};

export default Header;
