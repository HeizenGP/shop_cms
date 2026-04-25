import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';

const App = () => {
    return (
        <div className="p-10">
            <h1 className="text-2xl font-bold text-blue-600">
                Panel de Control: Shop CMS
            </h1>
            <p className="mt-4 text-gray-600">
                React + TypeScript + Tailwind están funcionando.
            </p>
        </div>
    );
};

const rootElement = document.getElementById('app');
if (rootElement) {
    const root = createRoot(rootElement);
    root.render(<App />);
}
