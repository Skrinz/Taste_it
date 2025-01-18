import React from 'react';
import Announcement from './Announcement';
import '../Styles/Announcements.css';

function Announcements(props) {
    const displayAnnouncements = () => {
        return props.announcements.map((announcement, index) => {
            return <Announcement key={index} announcement={announcement}/>;
        });
    };

    return <div className='AnnouncementList'>
            <div className='title'>
                <i className='fa fa-newspaper-o fa-lg newspaper'/>
                <h2>ACADEMIC ANNOUNCEMENTS</h2>
            </div>
            {displayAnnouncements()}
        </div>
};

export default Announcements;
