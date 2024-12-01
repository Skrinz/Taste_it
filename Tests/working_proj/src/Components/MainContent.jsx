import React, {useState, useEffect} from 'react';
import Announcements from './Announcements';
import '../Styles/MainContent.css';

const MainContent = () => {
    const [announcements, setAnnouncements] = useState([]);

    useEffect(() => {   
       fetch('https://jsonplaceholder.typicode.com/posts')
      .then(response => response.json())    
      .then(json => setAnnouncements(json));
    }, []);       
    
    return (
        <main className="main-content">
            <Announcements announcements={announcements} />
        </main>
    );
};

export default MainContent;
