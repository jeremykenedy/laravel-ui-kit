import React from 'react'

const variantMap = {
  primary: 'bg-blue-600 text-white hover:bg-blue-700 dark:bg-blue-600 dark:text-white dark:hover:bg-blue-500',
  secondary: 'bg-gray-600 text-white hover:bg-gray-700 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500',
  success: 'bg-green-600 text-white hover:bg-green-700 dark:bg-green-600 dark:text-white dark:hover:bg-green-500',
  danger: 'bg-red-600 text-white hover:bg-red-700 dark:bg-red-600 dark:text-white dark:hover:bg-red-500',
  warning: 'bg-amber-500 text-white hover:bg-amber-600 dark:bg-amber-500 dark:text-white dark:hover:bg-amber-400',
  info: 'bg-cyan-600 text-white hover:bg-cyan-700 dark:bg-cyan-600 dark:text-white dark:hover:bg-cyan-500',
}

const sizeMap = {
  xs: 'px-2 py-1 text-xs',
  sm: 'px-3 py-1.5 text-sm',
  md: 'px-4 py-2 text-sm',
  lg: 'px-5 py-2.5 text-base',
  xl: 'px-6 py-3 text-lg',
}

export default function UiButton({
  variant = 'primary',
  size = 'md',
  type = 'button',
  href = null,
  disabled = false,
  loading = false,
  block = false,
  children,
  className = '',
  onClick,
  ...props
}) {
  const classes = [
    'inline-flex items-center justify-center font-medium rounded-lg transition-colors duration-150 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 dark:focus-visible:ring-offset-gray-800 motion-reduce:transition-none',
    sizeMap[size] || sizeMap.md,
    variantMap[variant] || variantMap.primary,
    block ? 'w-full' : '',
    (disabled || loading) ? 'opacity-50 cursor-not-allowed' : '',
    className,
  ].filter(Boolean).join(' ')

  const Tag = href ? 'a' : 'button'

  return (
    <Tag
      className={classes}
      type={!href ? type : undefined}
      href={disabled || loading ? undefined : href}
      aria-disabled={href && (disabled || loading) ? 'true' : undefined}
      tabIndex={href && (disabled || loading) ? -1 : undefined}
      disabled={disabled || loading}
      onClick={event => {
        if (disabled || loading) {
          event.preventDefault()
          return
        }
        onClick?.(event)
      }}
      {...props}
    >
      {loading && (
        <svg className="animate-spin -ml-1 mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24">
          <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4" />
          <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
        </svg>
      )}
      {children}
    </Tag>
  )
}
