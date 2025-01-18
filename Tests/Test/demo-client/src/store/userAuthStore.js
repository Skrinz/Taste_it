import {create} from "zustand";

const useAuthStore = create((set) => ({
    token: null,
    isAuthenticated: false,
    setToken: (token) => set({token}),
    setIsAuthenticated: (isAuthenticated) =>set({isAuthenticated}),
}));

export default useAuthStore;