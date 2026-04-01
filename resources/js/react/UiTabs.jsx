import React,{useState} from 'react'
export default function UiTabs({tabs=[],active,onTabChange,children}){
  const[activeTab,setActive]=useState(active||tabs[0]||'')
  const select=t=>{setActive(t);onTabChange?.(t)}
  return(<div><div className="border-b border-gray-200 dark:border-gray-700"><nav className="-mb-px flex space-x-8">{tabs.map(t=><button key={t} onClick={()=>select(t)} type="button" className={`whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium ${activeTab===t?'border-blue-500 text-blue-600':'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700'}`}>{t}</button>)}</nav></div><div className="mt-4">{typeof children==='function'?children(activeTab):children}</div></div>)
}