import React from "react";
import { Navigate } from "react-router-dom";
import useAuthStore from "../store/userAuthStore";

function ProtectedRoute({element}){
    const = isAuthenticated = useAuthStore((state) => state.isAuthenticated);
    return isAuthenticated ?
}