import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import "../Styles/ManageAccount.css";

const InputContainer = ({ label, icon, inputType, name, placeholder, handleChanges }) => {
  return (
    <div className="input-container">
      <label>{label}</label>
      <div className="input-wrapper">
        <FontAwesomeIcon icon={icon} className="icons" />
        <input
          type={inputType}
          name={name}
          className="input-field"
          placeholder={placeholder}
          onChange={handleChanges}
        />
      </div>
    </div>
  );
};

export default InputContainer;
