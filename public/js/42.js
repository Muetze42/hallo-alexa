"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[42],{5042:(e,n,t)=>{t.r(n),t.d(n,{default:()=>s});var l=t(5166),o={id:"container"},a=(0,l.createElementVNode)("h1",null,"hallo_alexa_",-1),r={id:"links"},c=["href","onClick"];const i={name:"Index",props:{links:Object},methods:{count:function(e){axios.post("/api/link/"+e,{api:!0})}},render:function(e,n,t,i,s,k){return(0,l.openBlock)(),(0,l.createElementBlock)("div",o,[a,(0,l.createElementVNode)("div",r,[((0,l.openBlock)(!0),(0,l.createElementBlock)(l.Fragment,null,(0,l.renderList)(t.links,(function(e){return(0,l.openBlock)(),(0,l.createElementBlock)("a",{href:e.target,target:"_blank",class:(0,l.normalizeClass)(["btn","btn-"+e.id]),rel:"noopener",onClick:function(n){return k.count(e.id)}},[(0,l.createElementVNode)("i",{class:(0,l.normalizeClass)(["fw-fw",e.icon])},null,2),(0,l.createTextVNode)(" "+(0,l.toDisplayString)(e.name),1)],10,c)})),256))])])}},s=i}}]);