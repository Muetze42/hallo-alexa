(self.webpackChunk=self.webpackChunk||[]).push([[153,233],{1153:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>C});var o=n(5166),r=(0,o.createVNode)("h1",null,"Kontakt",-1),i={key:0,class:"contact-success"},a=(0,o.createVNode)("p",null,"Vielen Dank für Deine Nachricht.",-1),c=(0,o.createVNode)("p",null,null,-1),s=(0,o.createVNode)("i",{class:"far fa-envelope fa-5x"},null,-1),l={class:"form-row"},d=(0,o.createVNode)("label",{for:"subject"}," Betreff ",-1),u={class:"form-row"},m=(0,o.createVNode)("label",{for:"message"}," Nachricht ",-1),f={class:"form-row"},p=(0,o.createVNode)("label",{for:"email"}," E-Mail-Adresse ",-1),h={class:"form-row"},V=(0,o.createVNode)("label",{for:"confirm"}," E-Mail-Adresse bestätigen ",-1),N={key:0},k={class:"confirmations"},b=(0,o.createVNode)("label",{for:"confirmation"},"Datenschutzbestimmungen bestätigen",-1),g={class:"form-row submit-row"},v={class:"ping-container"},B={key:0,class:"ping-1"},y=(0,o.createVNode)("span",{class:"ping-2"},null,-1),x=(0,o.createVNode)("span",{class:"ping-3"},null,-1);const w={layout:n(3233).default,name:"Index",props:{subject:String,message:String,email:String,confirm:String,confirmation:Boolean},data:function(){return{confirmed:!0,sending:!1,disabled:!0,sent:!1}},methods:{submit:_.debounce((function(){var e=this;this.sending=!0,this.disabled=!0,axios.post(route("contact.store"),{_token:this._token,subject:this.subject,message:this.message,email:this.email,confirm:this.confirm}).then((function(t){e.sent=!0})).catch((function(e){alert(e.response.data)})),this.sending=!1}),100),isDisabled:function(){return this.mailConfirmed(),this.sending?this.disabled=!0:this.subject&&this.message&&this.email&&this.confirm&&this.confirmed?this.disabled=!1:this.disabled=!0},mailConfirmed:function(){var e=this.email,t=this.confirm;if(!t||!e)return this.confirmed=!0;var n=e.trim(),o=t.trim();return this.confirmed=n===o}},render:function(e,t,n,w,C,D){return(0,o.openBlock)(),(0,o.createBlock)(o.Fragment,null,[r,e.sent?((0,o.openBlock)(),(0,o.createBlock)("div",i,[a,c,s])):(0,o.createCommentVNode)("",!0),e.sent?(0,o.createCommentVNode)("",!0):((0,o.openBlock)(),(0,o.createBlock)("form",{key:1,onKeyup:t[8]||(t[8]=function(e){return D.isDisabled()}),onSubmit:t[9]||(t[9]=(0,o.withModifiers)((function(){return D.submit&&D.submit.apply(D,arguments)}),["prevent"]))},[(0,o.createVNode)("div",l,[d,(0,o.withDirectives)((0,o.createVNode)("input",{id:"subject",type:"text",placeholder:"Betreff","onUpdate:modelValue":t[1]||(t[1]=function(e){return n.subject=e}),maxlength:"50",required:""},null,512),[[o.vModelText,n.subject]])]),(0,o.createVNode)("div",u,[m,(0,o.withDirectives)((0,o.createVNode)("textarea",{id:"message","onUpdate:modelValue":t[2]||(t[2]=function(e){return n.message=e}),required:""},"Nachricht",512),[[o.vModelText,n.message]])]),(0,o.createVNode)("div",f,[p,(0,o.withDirectives)((0,o.createVNode)("input",{id:"email",type:"email",placeholder:"E-Mail-Adresse",autocomplete:"email","onUpdate:modelValue":t[3]||(t[3]=function(e){return n.email=e}),onKeyup:t[4]||(t[4]=function(e){return D.mailConfirmed()}),required:""},null,544),[[o.vModelText,n.email]])]),(0,o.createVNode)("div",h,[V,(0,o.withDirectives)((0,o.createVNode)("input",{id:"confirm",type:"email",placeholder:"E-Mail-Adresse bestätigen","onUpdate:modelValue":t[5]||(t[5]=function(e){return n.confirm=e}),onKeyup:t[6]||(t[6]=function(e){return D.mailConfirmed()}),required:""},null,544),[[o.vModelText,n.confirm]]),e.confirmed?(0,o.createCommentVNode)("",!0):((0,o.openBlock)(),(0,o.createBlock)("p",N,"Die eingegebenen E-Mail-Adressen stimmen nicht überein."))]),(0,o.createVNode)("div",k,[b,(0,o.withDirectives)((0,o.createVNode)("input",{id:"confirmation",type:"checkbox","onUpdate:modelValue":t[7]||(t[7]=function(e){return n.confirmation=e})},null,512),[[o.vModelCheckbox,n.confirmation]])]),(0,o.createVNode)("div",g,[(0,o.createVNode)("span",v,[(0,o.createVNode)("button",{type:"submit",disabled:e.disabled}," Nachricht senden ",8,["disabled"]),e.sending?((0,o.openBlock)(),(0,o.createBlock)("span",B,[y,x])):(0,o.createCommentVNode)("",!0)])])],32))],64)}},C=w},3233:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>h});var o=n(5166),r={id:"sidebar-draw"},i={key:0},a=(0,o.createVNode)("i",{class:"fas fa-times fa-2x"},null,-1),c={key:1},s=(0,o.createVNode)("i",{class:"fas fa-bars fa-2x"},null,-1),l=(0,o.createVNode)("span",{class:"sr-only"},"Open Menu",-1),d={role:"navigation"},u=(0,o.createVNode)("div",{id:"copyright"},[(0,o.createVNode)("a",{href:"https://huth.it",target:"_blank"},[(0,o.createTextVNode)(" Website "),(0,o.createVNode)("i",{class:"far fa-copyright"}),(0,o.createTextVNode)(" 2021 "),(0,o.createVNode)("span",null,"Norman Huth")])],-1),m={id:"container"};var f=n(9680);const p={props:{title:String,desc:String},data:function(){return{open:!1,dimmer:!0,menuItems:[{name:"Links",route:"home"},{name:"Kontakt",route:"contact.index"}]}},methods:{toggle:function(){this.open=!this.open},dd:function(){alert(this.route("home"))}},mounted:function(){var e=this;f.Inertia.on("navigate",(function(t){e.toggle()}))},render:function(e,t,n,f,p,h){var V=(0,o.resolveComponent)("inertia-head"),N=(0,o.resolveComponent)("inertia-link");return(0,o.openBlock)(),(0,o.createBlock)(o.Fragment,null,[(0,o.createVNode)(V,null,{default:(0,o.withCtx)((function(){return[(0,o.createVNode)("title",null,(0,o.toDisplayString)(n.title),1),(0,o.createVNode)("meta",{"head-key":"description",name:"description",content:n.desc},null,8,["content"])]})),_:1}),(0,o.createVNode)("div",{id:"sidebar",class:{"z-40":p.open}},[(0,o.createVNode)("div",r,[(0,o.createVNode)("button",{onClick:t[1]||(t[1]=(0,o.withModifiers)((function(e){return h.toggle()}),["prevent"])),id:"sidebar-button",class:"transition-color"},[p.open?((0,o.openBlock)(),(0,o.createBlock)("span",i,[a])):((0,o.openBlock)(),(0,o.createBlock)("span",c,[s])),l]),(0,o.createVNode)("div",{id:"sidebar-content",class:[p.open?"max-w-lg":"max-w-0"]},[(0,o.createVNode)("nav",d,[(0,o.createVNode)("ul",null,[((0,o.openBlock)(!0),(0,o.createBlock)(o.Fragment,null,(0,o.renderList)(p.menuItems,(function(t,n){return(0,o.openBlock)(),(0,o.createBlock)("li",{key:n},[e.route().current(t.route)?((0,o.openBlock)(),(0,o.createBlock)(N,{key:0,href:e.route(t.route),"aria-current":"page"},{default:(0,o.withCtx)((function(){return[(0,o.createTextVNode)((0,o.toDisplayString)(t.name),1)]})),_:2},1032,["href"])):((0,o.openBlock)(),(0,o.createBlock)(N,{key:1,href:e.route(t.route)},{default:(0,o.withCtx)((function(){return[(0,o.createTextVNode)((0,o.toDisplayString)(t.name),1)]})),_:2},1032,["href"]))])})),128))])]),u],2)]),(0,o.createVNode)(o.Transition,{name:"fade"},{default:(0,o.withCtx)((function(){return[p.dimmer&&p.open?((0,o.openBlock)(),(0,o.createBlock)("div",{key:0,onClick:t[2]||(t[2]=function(e){return h.toggle()}),id:"sidebar-fade",class:"active:outline-none"})):(0,o.createCommentVNode)("",!0)]})),_:1})],2),(0,o.createVNode)("main",{class:{"z-40":!p.open}},[(0,o.createVNode)("div",m,[(0,o.renderSlot)(e.$slots,"default")])],2)],64)}},h=p}}]);