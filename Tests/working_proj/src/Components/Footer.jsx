import React from 'react';
import '../Styles/Footer.css'; 
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faGlobeAmericas, faCode} from '@fortawesome/free-solid-svg-icons';

const Footer = () => {
    return (
      <footer className='footer'>
        <div className='footer-main'>
            <div className='about-us'>
                <h2><strong>ABOUT US</strong></h2>
                <div className='about-us-content'>
                    A mix of old and new marks USC's brand of education. The missionary spirit is kept alive with the school's pursuit for the latest in science, technology, and the arts. A sense of heritage blends well with the Carolinian enthusiasm for the new. And this is the best shown in the increasingly eclectic look of the school's architecture.
                </div> 
            </div>

            <div className='links'>
                <h2><strong>LINKS</strong></h2>
                <div className='links-content'>
                    <FontAwesomeIcon icon={faGlobeAmericas}  className="footer-icon" />
                    <p>Academic Calendar</p>
                </div>
                <div className='links-content'>
                    <FontAwesomeIcon icon={faGlobeAmericas}  className="footer-icon" />
                    <p>USC Website</p>
                </div>
            </div>

            <div className='modules'>
                <h2><strong>ISMIS2 MODULES</strong></h2>
                <div className='modules-content'>
                    <FontAwesomeIcon icon={faCode}  className="footer-icon" />
                    <p>Administrative Module</p>
                </div>
                <div className='modules-content'>
                    <FontAwesomeIcon icon={faCode}  className="footer-icon" />
                    <p>Finance Module</p>
                </div>
            </div>

            <div className='contact-us'>
                <h2><strong>CONTACT US</strong></h2>
                <div>
                    <p>P. del Rosario Street, Cebu City</p>
                    <p>Philippines 6000</p>
                    <p>Phone: +63 (32) 253 1000</p>
                    <p>Fax: +63 (32) 253 4341</p>
                    <p>E-mail: information@usc.edu.ph</p>
                    <p>Website: usc.edu.ph</p>
                </div>
            </div>
        </div>

        <div className='footer-sub'>
            <p>2024 &copy; UNIVERSITY OF SAN CARLOS-ISMIS Version 2.0</p>
        </div>
      </footer>
    );
  };

export default Footer