import React from 'react'
export default function UiCheckbox({name,label,description,checked,disabled,onChange}){
  return(<div className="flex items-start"><input type="checkbox" id={name} checked={checked} disabled={disabled} onChange={e=>onChange?.(e.target.checked)} className="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 mt-0.5"/>{label&&<div className="ml-3 text-sm"><label htmlFor={name} className="font-medium text-gray-700 dark:text-gray-300">{label}</label>{description&&<p className="text-gray-500">{description}</p>}</div>}</div>)
}