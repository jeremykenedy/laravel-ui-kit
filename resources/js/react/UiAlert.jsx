import React, { useState } from 'react'

const variants = {
  success: 'bg-green-50 text-green-800 border-green-200',
  danger: 'bg-red-50 text-red-800 border-red-200',
  warning: 'bg-amber-50 text-amber-800 border-amber-200',
  info: 'bg-blue-50 text-blue-800 border-blue-200',
}

export default function UiAlert({ variant = 'info', dismissible = true, title = null, children }) {
  const [visible, setVisible] = useState(true)
  if (!visible) return null

  return (
    <div className={`rounded-lg border p-4 ${variants[variant] || variants.info}`} role="alert">
      <div className="flex items-start">
        <div className="flex-1">
          {title && <h3 className="text-sm font-medium">{title}</h3>}
          <div className={title ? 'mt-1 text-sm opacity-90' : 'text-sm'}>{children}</div>
        </div>
        {dismissible && (
          <button onClick={() => setVisible(false)} className="ml-3 opacity-60 hover:opacity-100">
            <svg className="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clipRule="evenodd"/></svg>
          </button>
        )}
      </div>
    </div>
  )
}
