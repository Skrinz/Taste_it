import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const LoginPage = () => {
  const [email, setEmail] = useState('');
  const [name, setName] = useState('');
  const setToken = useAuthStore((state) => state.setToken)
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
        const response = await axios.post('/users/login', {
          email,
          name,
        });
  
        if (response.status === 200) {
          // const token = response.data.user;
          // localStorage.setItem("authToken", token);
          console.log('Login successful:', response.data);
          const data = await response.json();
          
          console.log(data);
          setToken(data.token);
          setIsAuthenticated(true);
          navigate('/dashboard'); 
          
        }
      } catch (error) {
        console.error('Error logging user:', error);
        alert('Login failed, please try again.');   
      }
  };

  return (
    <div>
      <h2>Login</h2>
      <form onSubmit={handleLogin}>
        <div>
          <label>Email:</label>
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </div>
        <div>
          <label>Name:</label>
          <input
            type="text"
            value={name}
            onChange={(e) => setName(e.target.value)}
            required
          />
        </div>
        <button type="submit">Login</button>
      </form>
      <p>
        Don't have an account?{' '}
        <span onClick={() => navigate('/register')}>Register here</span>
      </p>
    </div>
  );
};

export default LoginPage;
