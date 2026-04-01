import React,{useState,useRef,useEffect} from 'react'
export default function UiDropdown({trigger,align='right',children}){
  const[open,setOpen]=useState(false)
  const ref=useRef(null)
  useEffect(()=>{const h=e=>{if(ref.current&&!ref.current.contains(e.target))setOpen(false)};document.addEventListener('mousedown',h);return()=>document.removeEventListener('mousedown',h)},[])
  return(<div className="relative" ref={ref}><div onClick={()=>setOpen(!open)}>{trigger}</div>{open&&<div className={`absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5 ${align==='right'?'right-0':'left-0'}`}><div className="py-1" onClick={()=>setOpen(false)}>{children}</div></div>}</div>)
}