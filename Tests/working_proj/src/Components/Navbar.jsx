import React from 'react';
import '../Styles/Navbar.css'; 
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faAngleRight, faAngleDown} from '@fortawesome/free-solid-svg-icons';
import { faGetPocket } from '@fortawesome/free-brands-svg-icons';

const Navbar = () => {
  return (
    <div className='navbar'>
          
          <div className="dropdown">
            <button className="dropbtn">Home
            </button>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Features
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>

            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
                <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Enrollment Related
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Privacy Policy Statement
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
                <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                USC Privacy Policy Statement
              <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Meet CALOY
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                ECaloy Kiosk Location
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Caloy Mobile Version
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">SAFAD Magazine
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Lantawan Magazine
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                SAFAD Facebook Frame
              <FontAwesomeIcon icon={faAngleRight}/>
              </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Student Task
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Others
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Enrollment Related
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Enrollment Guide
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Library Related
              <FontAwesomeIcon icon={faAngleRight}/>
              </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Student Services
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Student Manual/Handbook
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Counselling and Development
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Campus Ministry
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Online Purchase(Textbook Dept)
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Online Purchase
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Motor Vehicle Pass
              <i className="fa fa-angle-down"style={{marginLeft: '10px'}}></i>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Sticker Application
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Evaluation
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Evaluation
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Administrative
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Campus Entry Application
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Faculty Utilization
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Job Placement
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Job Openings
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">OSA
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Student Organization
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Activity Permit
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Downloadable Forms
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Vice-President for Finance
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Office of the Registrar
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                IRM Office
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Learning Resource Center
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Vice-President for Administration
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">Promissory Note
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Apply Promissory Note
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 

          <div className="dropdown">
            <button className="dropbtn">USC Publishing House
              <FontAwesomeIcon icon={faAngleDown} style={{marginLeft: '10px'}}/>
            </button>
            <div className="dropdown-content">
              <a href='#' className='dropdown-item'>
              <FontAwesomeIcon icon={faGetPocket} className='pocket fa-lg'/>
                Digital Books
                <FontAwesomeIcon icon={faAngleRight}/>
                </a>
            </div>
          </div> 
        </div>

    );
};  

export default Navbar;
