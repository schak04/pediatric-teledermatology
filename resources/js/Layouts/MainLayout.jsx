import { useState, useEffect } from 'react';
import { Outlet, Link } from 'react-router-dom';
import { Sun, Moon, Stethoscope } from 'lucide-react';

const MainLayout = () => {
    const [darkMode, setDarkMode] = useState(
        localStorage.getItem('theme') === 'dark' || 
        (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
    );

    useEffect(() => {
        if (darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    }, [darkMode]);

    return (
        <div className="min-h-screen bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 transition-colors duration-300">
            {/* Navigation */}
            <nav className="sticky top-0 z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16 items-center">
                        <div className="flex items-center gap-2">
                            <Stethoscope className="text-blue-600 dark:text-blue-400" size={28} />
                            <span className="text-xl font-bold tracking-tight">TeleDerm <span className="text-blue-600">Peds</span></span>
                        </div>
                        
                        <div className="flex items-center gap-6">
                            <div className="hidden md:flex items-center gap-4 text-sm font-medium">
                                <Link to="/" className="hover:text-blue-600 transition-colors">Home</Link>
                                <Link to="/login" className="hover:text-blue-600 transition-colors">Login</Link>
                                <Link to="/register" className="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">Get Started</Link>
                            </div>

                            <button 
                                onClick={() => setDarkMode(!darkMode)}
                                className="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                            >
                                {darkMode ? <Sun size={20} /> : <Moon size={20} />}
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Content Area */}
            <main className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                <Outlet />
            </main>

            {/* Footer */}
            <footer className="mt-auto py-8 border-t border-slate-200 dark:border-slate-800 text-center text-sm text-slate-500">
                &copy; {new Date().getFullYear()} Pediatric Teledermatology Platform. All rights reserved.
            </footer>
        </div>
    );
};

export default MainLayout;
