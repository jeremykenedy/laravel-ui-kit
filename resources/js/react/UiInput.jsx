import React from 'react'

export default function UiInput({
  type = 'text', name, id, label, placeholder, hint, error,
  value, onChange, required = false, disabled = false, className = '',
}) {
  const hasError = !!error
  const inputId = id || name

  return (
    <div>
      {label && (
        <label htmlFor={inputId} className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
          {label}{required && <span className="text-red-500"> *</span>}
        </label>
      )}
      <input
        type={type} name={name} id={inputId} placeholder={placeholder}
        value={value} onChange={onChange} required={required} disabled={disabled}
        className={`block w-full rounded-lg border transition-colors duration-150 focus:outline-none focus:ring-2 sm:text-sm dark:bg-gray-800 ${hasError ? 'border-red-300 focus:border-red-500 focus:ring-red-500' : 'border-gray-300 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600'} ${className}`}
      />
      {hasError && <p className="mt-1 text-sm text-red-600">{error}</p>}
      {!hasError && hint && <p className="mt-1 text-sm text-gray-500">{hint}</p>}
    </div>
  )
}
