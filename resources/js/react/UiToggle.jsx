import React from 'react'

export default function UiToggle({ checked = false, onChange, label, disabled = false }) {
  return (
    <label className={`inline-flex items-center ${disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer'}`}>
      <span className={`relative inline-flex flex-shrink-0 h-6 w-11 rounded-full border-2 border-transparent transition-colors duration-200 ${checked ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'}`} onClick={() => !disabled && onChange?.(!checked)} role="switch" aria-checked={checked}>
        <span className={`pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 ${checked ? 'translate-x-5' : 'translate-x-0'}`} />
      </span>
      {label && <span className="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{label}</span>}
    </label>
  )
}
