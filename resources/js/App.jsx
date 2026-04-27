import { Routes, Route } from 'react-router-dom';
import MainLayout from './Layouts/MainLayout';

const App = () => {
    return (
        <Routes>
            <Route path="/" element={<MainLayout />}>
                <Route index element={<div className="p-8"><h1>Welcome to Pediatric Teledermatology</h1><p>Because every child deserves healthy skin.</p></div>} />
                <Route path="login" element={<div className="p-8">Login Page (yet to make)</div>} />
                <Route path="register" element={<div className="p-8">Register Page (yet to make)</div>} />
            </Route>
        </Routes>
    );
};

export default App;
