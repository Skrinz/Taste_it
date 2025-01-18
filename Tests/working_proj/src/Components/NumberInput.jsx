import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

const NumberInput = ({ label, icon, options, name, placeholder, handleChange }) => {
  return (
    <div className="input-container">
      <label>{label}</label>
      <div className="input-wrapper">
        <FontAwesomeIcon icon={icon} className="icons" />
        <select
          name={name}
          className="input-field type3"
          onChange={handleChange}
        >
          <option value="">{placeholder}</option>
          {options.map((option, index) => (
            <option key={index} value={option}>
              {option}
            </option>
          ))}
        </select>
      </div>
    </div>
  );
};

export default NumberInput;