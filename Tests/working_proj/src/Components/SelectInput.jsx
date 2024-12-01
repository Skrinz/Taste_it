import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';

const SelectInput = ({ label, icon, options, name, placeholder, handleChange }) => {
  return (
    <div className="input-container">
      <label>{label}</label>
      <div className="input-wrapper">
        <FontAwesomeIcon icon={icon} className="icons" />
        <select
          name={name}
          className="input-field type2"
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

export default SelectInput;
