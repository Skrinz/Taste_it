import React from 'react';
import Header from './Header';
import Navbar from './Navbar';
import MainContent from './MainContent';
import Footer from './Footer';


const Dashboard = () => {
    return (
      <div id="root">
        <Header />
        <Navbar />
        <MainContent />
        <Footer />
      </div>
    );
  };
  
export default Dashboard;