import React, {useState, useEffect} from "react";
import { useParams } from "react-router-dom";
import '../Styles/Announcement.css';

function AnnouncementDetails(){
    const {id} = useParams();
    const [post, setPost] = useState(null);

    useEffect(() => {
       fetch(`https://jsonplaceholder.typicode.com/posts/${id}`)
      .then(response => response.json()) 
      .then((data) => setPost(data));
    }, [id]);


    if(!post){
        return <div>Loading...</div>;
    }

    return(
        <div className="announcement">
            <img src="" alt="pfp" className='pfpImage'/>

            <div className='announcement-box'>
                <div className='body-arrow'></div>
                <div className='announcement-name'>{post.userId}</div>
                <div className='announcement-capt'>{post.id}</div>
                <div className="announcement-title">
                    <strong>{post.title}</strong>
                </div>
                <div className="announcement-content">
                    <p>{post.body}</p>
                </div>
            </div>
        </div>
    );
}

export default AnnouncementDetails;
