import React, { useId } from 'react'

export default function UiToggle({ checked = false, onChange, label, disabled = false, toggleLabel = 'Toggle' }) {
  const labelId = useId()

  return (
    <span className={`inline-flex items-center ${disabled ? 'opacity-50' : ''}`}>
      <button
        type="button"
        role="switch"
        aria-checked={checked}
        aria-labelledby={label ? labelId : undefined}
        aria-label={label ? undefined : toggleLabel}
        disabled={disabled}
        className={`relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2 disabled:cursor-not-allowed motion-reduce:transition-none dark:focus-visible:ring-offset-gray-800 ${checked ? 'bg-blue-600' : 'bg-gray-200 dark:bg-gray-600'}`}
        onClick={() => !disabled && onChange?.(!checked)}
      >
        <span className={`pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 motion-reduce:transition-none ${checked ? 'translate-x-5' : 'translate-x-0'}`} />
      </button>
      {label && <span id={labelId} className="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">{label}</span>}
    </span>
  )
}
