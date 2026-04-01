import React,{useState} from 'react'
export default function UiDataTable({headers=[],onSort,children}){
  const[sf,setSf]=useState('')
  const[sd,setSd]=useState('asc')
  const sort=h=>{const d=sf===h&&sd==='asc'?'desc':'asc';setSf(h);setSd(d);onSort?.({field:h,direction:d})}
  return(<div className="overflow-x-auto"><table className="min-w-full divide-y divide-gray-200 dark:divide-gray-700"><thead className="bg-gray-50 dark:bg-gray-800"><tr>{headers.map(h=><th key={h} onClick={()=>sort(h)} className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:text-gray-700">{h}{sf===h&&<span className="ml-1">{sd==='asc'?'↑':'↓'}</span>}</th>)}</tr></thead><tbody className="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">{children}</tbody></table></div>)
}