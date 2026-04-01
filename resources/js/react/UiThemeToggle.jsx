import React, { useState, useEffect, useRef } from 'react';

const SunIcon = () => (
  <svg className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
);
const MoonIcon = () => (
  <svg className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
);
const MonitorIcon = () => (
  <svg className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"><path strokeLinecap="round" strokeLinejoin="round" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
);

const options = [
  { value: 'light', label: 'Light', Icon: SunIcon },
  { value: 'dark', label: 'Dark', Icon: MoonIcon },
  { value: 'system', label: 'System', Icon: MonitorIcon },
];

function apply(mode) {
  const isDark = mode === 'dark' || (mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
  document.documentElement.classList.toggle('dark', isDark);
}

export default function UiThemeToggle({ initialMode = 'system', saveUrl = '', csrfToken = '' }) {
  const [open, setOpen] = useState(false);
  const [current, setCurrent] = useState(initialMode);
  const ref = useRef(null);

  useEffect(() => {
    const stored = localStorage.getItem('theme');
    if (stored) setCurrent(stored);
    apply(stored || initialMode);

    const handler = (e) => { if (ref.current && !ref.current.contains(e.target)) setOpen(false); };
    document.addEventListener('mousedown', handler);
    return () => document.removeEventListener('mousedown', handler);
  }, []);

  function setTheme(mode) {
    setCurrent(mode);
    localStorage.setItem('theme', mode);
    apply(mode);
    setOpen(false);

    if (saveUrl) {
      fetch(saveUrl, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken || document.querySelector('meta[name=csrf-token]')?.content,
          'Accept': 'application/json',
        },
        body: JSON.stringify({ dark_mode: mode }),
      }).catch(() => {});
    }
  }

  const CurrentIcon = current === 'light' ? SunIcon : current === 'dark' ? MoonIcon : MonitorIcon;

  return (
    <div className="relative" ref={ref}>
      <button onClick={() => setOpen(!open)} type="button" className="inline-flex items-center p-2 rounded-md text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors" title="Toggle theme">
        <CurrentIcon />
      </button>
      {open && (
        <div className="absolute right-0 mt-1 w-36 rounded-lg bg-white dark:bg-gray-800 shadow-lg ring-1 ring-gray-200 dark:ring-gray-700 z-50">
          <div className="py-1">
            {options.map(({ value, label, Icon }) => (
              <button key={value} onClick={() => setTheme(value)} type="button" className={`flex items-center gap-2 w-full px-4 py-2 text-sm hover:bg-gray-50 dark:hover:bg-gray-700 ${current === value ? 'font-medium text-gray-900 dark:text-gray-100' : 'text-gray-500 dark:text-gray-400'}`}>
                <Icon /> {label}
              </button>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
