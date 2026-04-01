import React from 'react'
export default function UiStatusPanel({message,variant='info',icon,children}){
  const cls={success:'text-green-600',danger:'text-red-600',warning:'text-amber-600',info:'text-blue-600'}
  return(<div className="text-center py-12">{icon&&<div className={`mx-auto mb-4 ${cls[variant]||cls.info}`}><svg className="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>}<p className="text-gray-500">{message}</p>{children&&<div className="mt-4">{children}</div>}</div>)
}