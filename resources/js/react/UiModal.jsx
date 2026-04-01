import React from 'react'
import { createPortal } from 'react-dom'

const sizes = { sm: 'sm:max-w-sm', md: 'sm:max-w-lg', lg: 'sm:max-w-2xl', xl: 'sm:max-w-4xl' }

export default function UiModal({ open, onClose, title, size = 'md', closeable = true, children, footer }) {
  if (!open) return null
  return createPortal(
    <div className="fixed inset-0 z-50 overflow-y-auto">
      <div className="flex min-h-screen items-center justify-center p-4">
        <div className="fixed inset-0 bg-black/50" onClick={() => closeable && onClose?.()} />
        <div className={`relative w-full ${sizes[size] || sizes.md} rounded-xl bg-white dark:bg-gray-800 shadow-xl`}>
          {(title || closeable) && (
            <div className="flex items-center justify-between border-b border-gray-200 dark:border-gray-700 px-6 py-4">
              {title && <h3 className="text-lg font-medium text-gray-900 dark:text-gray-100">{title}</h3>}
              {closeable && <button onClick={onClose} className="text-gray-400 hover:text-gray-500"><svg className="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fillRule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clipRule="evenodd"/></svg></button>}
            </div>
          )}
          <div className="px-6 py-4">{children}</div>
          {footer && <div className="border-t border-gray-200 dark:border-gray-700 px-6 py-4 flex justify-end gap-3">{footer}</div>}
        </div>
      </div>
    </div>,
    document.body
  )
}
