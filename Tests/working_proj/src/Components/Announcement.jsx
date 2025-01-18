import React from 'react';
import '../Styles/Announcement.css';
import { Link } from 'react-router-dom';

function Announcement(props){

    // const {image ,name, department, date, title, content} = props.announcement;
    const { userId, id, title, body} = props.announcement;

    return (
        // <div className="announcement">
        //     <img src={image} alt="pfp" className='pfpImage'/>

        //     <div className='announcement-box'>
        //         <div className='body-arrow'></div>
        //         <div className='announcement-name'>{name}</div>
        //         <div className='announcement-capt'>{department}</div>
        //         <div className='announcement-capt'>{date}</div>
        //         <div className="announcement-title">
        //             <strong>{title}</strong>
        //         </div>
        //         <div className="announcement-content">
        //             <p>{content}</p>
        //         </div>
        //     </div>
        // </div>

        <div className="announcement">
            <img src="" alt="pfp" className='pfpImage'/>

            <div className='announcement-box'>
                <div className='body-arrow'></div>
                <div className='announcement-name'>{userId}</div>
                <div className='announcement-capt'>{id}</div>
                <div className="announcement-title">
                    <Link to={`/announcement/${id}`}><strong>{title}</strong></Link>
                </div>
                <div className="announcement-content">
                    <p>{body}</p>
                </div>
            </div>
        </div>
    );
};

export default Announcement;
