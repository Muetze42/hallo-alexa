(self.webpackChunk=self.webpackChunk||[]).push([[682],{9682:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>k});var o=n(5166),r={id:"sidebar-draw"},a={key:0},i=(0,o.createVNode)("i",{class:"fas fa-times menu-switch"},null,-1),c={key:1},l=(0,o.createVNode)("i",{class:"fas fa-bars menu-switch"},null,-1),u=(0,o.createVNode)("span",{class:"sr-only"},"Open Menu",-1),s={role:"navigation"};var d=n(9680);const p={props:{title:String,desc:String},data:function(){return{open:!1,dimmer:!0,menuItems:[{name:"Links",route:"home"},{name:"Kontakt",route:"contact.index"}]}},methods:{toggle:function(){this.open=!this.open}},mounted:function(){var e=this;d.Inertia.on("navigate",(function(t){e.toggle()}))},render:function(e,t,n,d,p,k){var f=(0,o.resolveComponent)("inertia-head"),m=(0,o.resolveComponent)("inertia-link");return(0,o.openBlock)(),(0,o.createBlock)(o.Fragment,null,[(0,o.createVNode)(f,null,{default:(0,o.withCtx)((function(){return[(0,o.createVNode)("title",null,(0,o.toDisplayString)(n.title),1),(0,o.createVNode)("meta",{"head-key":"description",name:"description",content:n.desc},null,8,["content"])]})),_:1}),(0,o.createVNode)("div",{id:"sidebar",class:{"z-40":p.open}},[(0,o.createVNode)("div",r,[(0,o.createVNode)("button",{onClick:t[1]||(t[1]=(0,o.withModifiers)((function(e){return k.toggle()}),["prevent"])),id:"sidebar-button",class:"transition-color"},[p.open?((0,o.openBlock)(),(0,o.createBlock)("span",a,[i])):((0,o.openBlock)(),(0,o.createBlock)("span",c,[l])),u]),(0,o.createVNode)("div",{id:"sidebar-content",class:[p.open?"max-w-lg":"max-w-0"]},[(0,o.createVNode)("nav",s,[(0,o.createVNode)("ul",null,[((0,o.openBlock)(!0),(0,o.createBlock)(o.Fragment,null,(0,o.renderList)(p.menuItems,(function(t,n){return(0,o.openBlock)(),(0,o.createBlock)("li",{key:n},[e.route().current(t.route)?((0,o.openBlock)(),(0,o.createBlock)(m,{key:0,href:e.route(t.route),"aria-current":"page"},{default:(0,o.withCtx)((function(){return[(0,o.createTextVNode)((0,o.toDisplayString)(t.name),1)]})),_:2},1032,["href"])):((0,o.openBlock)(),(0,o.createBlock)(m,{key:1,href:e.route(t.route)},{default:(0,o.withCtx)((function(){return[(0,o.createTextVNode)((0,o.toDisplayString)(t.name),1)]})),_:2},1032,["href"]))])})),128))])])],2)]),(0,o.createVNode)(o.Transition,{name:"fade"},{default:(0,o.withCtx)((function(){return[p.dimmer&&p.open?((0,o.openBlock)(),(0,o.createBlock)("div",{key:0,onClick:t[2]||(t[2]=function(e){return k.toggle()}),id:"sidebar-fade",class:"active:outline-none"})):(0,o.createCommentVNode)("",!0)]})),_:1})],2),(0,o.createVNode)("main",null,[(0,o.renderSlot)(e.$slots,"default")])],64)}},k=p}}]);