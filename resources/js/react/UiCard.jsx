import React from 'react'

export default function UiCard({ title, subtitle, bordered = true, children, footer }) {
  return (
    <div className={`rounded-lg bg-white dark:bg-gray-800 shadow-sm ${bordered ? 'border border-gray-200 dark:border-gray-700' : ''}`}>
      {title && (
        <div className="border-b border-gray-200 dark:border-gray-700 p-4 sm:p-6">
          <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100">{title}</h3>
          {subtitle && <p className="mt-1 text-sm text-gray-500">{subtitle}</p>}
        </div>
      )}
      <div className="p-4 sm:p-6">{children}</div>
      {footer && <div className="border-t border-gray-200 dark:border-gray-700 p-4 sm:p-6 bg-gray-50 dark:bg-gray-800/50 rounded-b-lg">{footer}</div>}
    </div>
  )
}
