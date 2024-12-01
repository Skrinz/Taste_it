import React from 'react'
import Dashboard from './Components/Dashboard'
import LoginForm from './Components/LoginForm'
// import RegistrationForm from './Components/RegistrationForm'
import ManageAccount from './Components/ManageAccount'
import Landing from './Components/Landing'
import Settings from './Components/Settings'
import AnnouncementDetails from './Components/AnnouncementDetails'
import {BrowserRouter as Router, Routes, Route} from 'react-router-dom'


function App() {

  return (
    <Router>
      <Routes>
        <Route path='/' element={<Landing/>}/>
        <Route path='/dashboard' element={<Dashboard/>}/>
        <Route path='/announcement/:id' element={<AnnouncementDetails/>}/>
        <Route path='/login' element={<LoginForm/>}/>
        <Route path='/manageaccount' element={<ManageAccount/>}/>
        <Route path='/settings' element={<Settings/>}/>
      </Routes>
    </Router>
  )
}

export default App


//login
//manage account
//dashboard
//settings
//landing

// 1. landing
// 1. button click to go to Login done

// 2. in login 
// 2. click the pfp to go to Dashboard don

// 3. in Dashboard
// 3. button click to go to settings done

// 4. in settings
// 4. button click to go to manage ManageAccount
// 4. button click to go to login




