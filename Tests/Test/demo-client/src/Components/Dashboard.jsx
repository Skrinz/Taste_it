import React, { useState } from "react";
import axios from "axios";

  
const token = localStorage.getItem("authToken");
axios.defaults.headers.common["Authorization"] = token ? `${token}` : null;

const Dashboard = () => {
  const [noteId, setNoteId] = useState("");
  const [method, setMethod] = useState("GET");
  const [body, setBody] = useState("");
  const [response, setResponse] = useState(null);
  const [error, setError] = useState(null);

  const baseUrl = "/notes"; 

  const handleRequest = async (e) => {
    e.preventDefault();
    setError(null);
    setResponse(null);
  
    if (!token) {
      setError("Authorization token not found. Please log in.");
      return;
    }
  
    if ((method === "POST" || method === "PUT") && !body.trim()) {
      setError("Request body is required for POST and PUT methods.");
      return;
    }
  
    const url = noteId ? `${baseUrl}/${noteId}` : baseUrl;
    
    const config = {
      method,  
      url,     
      headers: {
        "Content-Type": "application/json",
        "Authorization": `${token}`, 
      },
    };
  
    if (method === "POST" || method === "PUT") {
      try {
        config.data = JSON.parse(body);  
      } catch (parseError) {
        setError("Invalid JSON format in the request body.");
        return;
      }
    }
  
    try {
      const res = await axios(config);
      setResponse(res.data);  
    } catch (err) {
      if (err.response) {
        setError(`Error: ${err.response.status} - ${err.response.data.message || err.response.statusText}`);
      } else {
        setError(`Error: ${err.message}`);
      }
    }
  };
  
  

  return (
    <div>
      <h2>Notes API Dashboard</h2>
      <form onSubmit={handleRequest}>
        <div>
          <label>Note ID (optional for GET/PUT/DELETE):</label>
          <input
            type="text"
            value={noteId}
            onChange={(e) => setNoteId(e.target.value)}
            placeholder="Enter note ID (e.g., 123)"
          />
        </div>
        <div>
          <label>Method:</label>
          <select value={method} onChange={(e) => setMethod(e.target.value)}>
            <option value="GET">GET</option>
            <option value="POST">POST</option>
            <option value="PUT">PUT</option>
            <option value="DELETE">DELETE</option>
          </select>
        </div>
        {(method === "POST" || method === "PUT") && (
          <div>
            <label>Request Body (JSON):</label>
            <textarea
              value={body}
              onChange={(e) => setBody(e.target.value)}
              placeholder='Enter JSON body (e.g., {"title": "Note Title", "content": "Note Content"})'
              rows="5"
              cols="40"
            />
          </div>
        )}
        <button type="submit">Send Request</button>
      </form>

      {response && (
        <div>
          <h3>Response:</h3>
          <pre>{JSON.stringify(response, null, 2)}</pre>
        </div>
      )}

      {error && (
        <div style={{ color: "red" }}>
          <h3>Error:</h3>
          <pre>{error}</pre>
        </div>
      )}
    </div>
  );
};

export default Dashboard;
