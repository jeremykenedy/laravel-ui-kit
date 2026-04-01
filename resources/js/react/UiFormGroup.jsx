import React from 'react'
export default function UiFormGroup({label,htmlFor,hint,error,required,children}){
  return(<div className="mb-4">{label&&<label htmlFor={htmlFor} className="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{label}{required&&<span className="text-red-500"> *</span>}</label>}{children}{error?<p className="mt-1 text-sm text-red-600">{error}</p>:hint?<p className="mt-1 text-sm text-gray-500">{hint}</p>:null}</div>)
}