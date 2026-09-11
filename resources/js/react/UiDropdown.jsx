import React, { useEffect, useId, useRef, useState } from 'react'

export default function UiDropdown({ trigger, align = 'right', children, toggleLabel = 'Toggle menu', label = 'Options' }) {
  const [open, setOpen] = useState(false)
  const root = useRef(null)
  const menuId = useId()

  useEffect(() => {
    function closeOnOutsideClick(event) {
      if (root.current && !root.current.contains(event.target)) {
        setOpen(false)
      }
    }

    document.addEventListener('mousedown', closeOnOutsideClick)

    return () => document.removeEventListener('mousedown', closeOnOutsideClick)
  }, [])

  return (
    <div className="relative" ref={root}>
      {trigger ? (
        <div
          aria-expanded={open}
          aria-haspopup="menu"
          aria-controls={menuId}
          onClick={() => setOpen(!open)}
        >
          {trigger}
        </div>
      ) : (
        <button
          type="button"
          aria-expanded={open}
          aria-haspopup="menu"
          aria-controls={menuId}
          aria-label={toggleLabel}
          onClick={() => setOpen(!open)}
        >
          {label}
        </button>
      )}
      {open && (
        <div
          id={menuId}
          role="menu"
          className={`absolute z-50 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black/5 dark:bg-gray-800 ${align === 'right' ? 'right-0' : 'left-0'}`}
        >
          <div className="py-1" onClick={() => setOpen(false)}>{children}</div>
        </div>
      )}
    </div>
  )
}
