import React from 'react'

const variants = { primary: 'bg-blue-100 text-blue-800', secondary: 'bg-gray-100 text-gray-800', success: 'bg-green-100 text-green-800', danger: 'bg-red-100 text-red-800', warning: 'bg-amber-100 text-amber-800', info: 'bg-cyan-100 text-cyan-800' }
const sizes = { sm: 'px-2 py-0.5 text-xs', md: 'px-2.5 py-0.5 text-xs', lg: 'px-3 py-1 text-sm' }

export default function UiBadge({ variant = 'primary', size = 'md', rounded = false, dot = false, children }) {
  return (
    <span className={`inline-flex items-center font-medium ${sizes[size] || sizes.md} ${variants[variant] || variants.primary} ${rounded ? 'rounded-full' : 'rounded'}`}>
      {dot && <span className="mr-1.5 h-1.5 w-1.5 rounded-full bg-current" />}
      {children}
    </span>
  )
}
