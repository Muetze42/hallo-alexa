(self.webpackChunk=self.webpackChunk||[]).push([[556,271,421],{5271:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>d});var o=n(5166),r=(0,o.withScopeId)("data-v-35f0511d");(0,o.pushScopeId)("data-v-35f0511d");var a={class:"header"},i={key:0,class:"footer"};(0,o.popScopeId)();var c=r((function(e,t,n,r,c,s){return(0,o.openBlock)(),(0,o.createBlock)("div",{class:["card",n.cardClass]},[(0,o.createVNode)("div",a,[(0,o.createVNode)("h1",null,(0,o.toDisplayString)(n.title),1)]),(0,o.createVNode)("div",{class:["body",n.bodyClass]},[(0,o.renderSlot)(e.$slots,"default",{},void 0,!0)],2),e.$slots.footer?((0,o.openBlock)(),(0,o.createBlock)("div",i,[(0,o.renderSlot)(e.$slots,"footer",{},void 0,!0)])):(0,o.createCommentVNode)("",!0)],2)}));const s={props:{title:String,bodyClass:String,cardClass:String},name:"Card",methods:{dd:function(e){console.log(e)}}};s.render=c,s.__scopeId="data-v-35f0511d";const d=s},9556:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>D});var o=n(5166),r={key:0,class:"contact-success"},a=(0,o.createVNode)("p",null,"Vielen Dank für Deine Nachricht.",-1),i=(0,o.createVNode)("i",{class:"far fa-envelope fa-5x"},null,-1),c={class:"form-row"},s=(0,o.createVNode)("label",{for:"name"}," Name ",-1),d={class:"form-row"},l=(0,o.createVNode)("label",{for:"subject"}," Betreff ",-1),u={class:"form-row"},m=(0,o.createVNode)("label",{for:"message"}," Nachricht ",-1),f={class:"form-row"},p=(0,o.createVNode)("label",{for:"email"}," E-Mail-Adresse ",-1),h={class:"form-row"},N=(0,o.createVNode)("label",{for:"confirm"}," E-Mail-Adresse bestätigen ",-1),V={key:0},k={class:"confirmations"},b=(0,o.createVNode)("label",{for:"confirmation"},"Datenschutzbestimmungen bestätigen",-1),g={class:"submit-row"},v={class:"ping-container"},B={key:0,class:"ping-1"},y=(0,o.createVNode)("span",{class:"ping-2"},null,-1),w=(0,o.createVNode)("span",{class:"ping-3"},null,-1);var C=n(4421),x=n(5271);const S={layout:C.default,name:"Index",props:{links:Object,subject:String,name:String,message:String,email:String,confirm:String,confirmation:Boolean},components:{Card:x.default},data:function(){return{confirmed:!0,sending:!1,disabled:!0,sent:!1}},methods:{submit:_.debounce((function(){var e=this;this.sending=!0,this.disabled=!0,axios.post(route("contact.store"),{_token:this._token,subject:this.subject,name:this.name,message:this.message,email:this.email,confirm:this.confirm}).then((function(t){e.sent=!0})).catch((function(t){t.response&&421===t.response.status?window.confirm(t.response.data)&&(e.sending=!1):window.confirm("Ein unbekannter Fehler ist aufgetreten. Bitte versuche es zu einem anderen Zeitpunkt nochmal")&&(e.sending=!1)}))}),10),isDisabled:function(){return this.mailConfirmed(),this.sending?this.disabled=!0:this.subject&&this.message&&this.email&&this.confirm&&this.confirmed?this.disabled=!1:this.disabled=!0},mailConfirmed:function(){var e=this.email,t=this.confirm;if(!t||!e)return this.confirmed=!0;var n=e.trim(),o=t.trim();return this.confirmed=n===o}},render:function(e,t,n,C,x,S){var D=(0,o.resolveComponent)("card");return(0,o.openBlock)(),(0,o.createBlock)("form",{onKeyup:t[9]||(t[9]=function(e){return S.isDisabled()}),onSubmit:t[10]||(t[10]=(0,o.withModifiers)((function(){return S.submit&&S.submit.apply(S,arguments)}),["prevent"]))},[(0,o.createVNode)(D,{title:"Kontakt",bodyClass:"form-body",cardClass:"w-80"},(0,o.createSlots)({default:(0,o.withCtx)((function(){return[e.sent?((0,o.openBlock)(),(0,o.createBlock)("div",r,[a,i])):(0,o.createCommentVNode)("",!0),e.sent?(0,o.createCommentVNode)("",!0):((0,o.openBlock)(),(0,o.createBlock)(o.Fragment,{key:1},[(0,o.createVNode)("div",c,[s,(0,o.withDirectives)((0,o.createVNode)("input",{id:"name",type:"text",placeholder:"Name","onUpdate:modelValue":t[1]||(t[1]=function(e){return n.name=e}),maxlength:"50",required:""},null,512),[[o.vModelText,n.name]])]),(0,o.createVNode)("div",d,[l,(0,o.withDirectives)((0,o.createVNode)("input",{id:"subject",type:"text",placeholder:"Betreff","onUpdate:modelValue":t[2]||(t[2]=function(e){return n.subject=e}),maxlength:"50",required:""},null,512),[[o.vModelText,n.subject]])]),(0,o.createVNode)("div",u,[m,(0,o.withDirectives)((0,o.createVNode)("textarea",{id:"message","onUpdate:modelValue":t[3]||(t[3]=function(e){return n.message=e}),required:""},"Nachricht",512),[[o.vModelText,n.message]])]),(0,o.createVNode)("div",f,[p,(0,o.withDirectives)((0,o.createVNode)("input",{id:"email",type:"email",placeholder:"E-Mail-Adresse",autocomplete:"email","onUpdate:modelValue":t[4]||(t[4]=function(e){return n.email=e}),onKeyup:t[5]||(t[5]=function(e){return S.mailConfirmed()}),required:""},null,544),[[o.vModelText,n.email]])]),(0,o.createVNode)("div",h,[N,(0,o.withDirectives)((0,o.createVNode)("input",{id:"confirm",type:"email",placeholder:"E-Mail-Adresse bestätigen","onUpdate:modelValue":t[6]||(t[6]=function(e){return n.confirm=e}),onKeyup:t[7]||(t[7]=function(e){return S.mailConfirmed()}),required:""},null,544),[[o.vModelText,n.confirm]]),e.confirmed?(0,o.createCommentVNode)("",!0):((0,o.openBlock)(),(0,o.createBlock)("p",V,"Die eingegebenen E-Mail-Adressen stimmen nicht überein."))])],64))]})),_:2},[e.sent?void 0:{name:"footer",fn:(0,o.withCtx)((function(){return[(0,o.createVNode)("div",k,[b,(0,o.withDirectives)((0,o.createVNode)("input",{id:"confirmation",type:"checkbox","onUpdate:modelValue":t[8]||(t[8]=function(e){return n.confirmation=e})},null,512),[[o.vModelCheckbox,n.confirmation]])]),(0,o.createVNode)("div",g,[(0,o.createVNode)("span",v,[(0,o.createVNode)("button",{type:"submit",disabled:e.disabled}," Nachricht senden ",8,["disabled"]),e.sending?((0,o.openBlock)(),(0,o.createBlock)("span",B,[y,w])):(0,o.createCommentVNode)("",!0)])])]}))}]),1024)],32)}},D=S},4421:(e,t,n)=>{"use strict";n.r(t),n.d(t,{default:()=>N});var o=n(5166),r={id:"sidebar-draw"},a={key:0},i=(0,o.createVNode)("i",{class:"fas fa-times menu-switch"},null,-1),c={key:1},s=(0,o.createVNode)("i",{class:"fas fa-bars menu-switch"},null,-1),d=(0,o.createVNode)("span",{class:"sr-only"},"Menü",-1),l={role:"navigation"},u={key:0},m=(0,o.createVNode)("a",{href:"/admin"},"Administration",-1),f=(0,o.createVNode)("div",{id:"copyright"},[(0,o.createVNode)("a",{href:"https://huth.it",target:"_blank"},[(0,o.createTextVNode)(" Website "),(0,o.createVNode)("i",{class:"far fa-copyright"}),(0,o.createTextVNode)(" 2021 "),(0,o.createVNode)("span",null,[(0,o.createVNode)("u",null,"Norman Huth"),(0,o.createVNode)("i",{class:"fa-fw fas fa-external-link"})])])],-1);var p=n(9680);const h={props:{metaTitle:String,metaDesc:String},data:function(){return{open:!1,dimmer:!0,menuItems:[{name:"Links",route:"home"},{name:"Kontakt",route:"contact.index"}]}},methods:{toggle:function(){this.open=!this.open}},updated:function(){document.title=this.metaTitle},mounted:function(){var e=this;p.Inertia.on("navigate",(function(t){e.toggle()}))},render:function(e,t,n,p,h,N){var V=(0,o.resolveComponent)("inertia-head"),k=(0,o.resolveComponent)("inertia-link");return(0,o.openBlock)(),(0,o.createBlock)(o.Fragment,null,[(0,o.createVNode)(V,null,{default:(0,o.withCtx)((function(){return[(0,o.createVNode)("meta",{"head-key":"description",name:"description",content:n.metaDesc},null,8,["content"])]})),_:1}),(0,o.createVNode)("div",{id:"sidebar",class:{"z-40":h.open}},[(0,o.createVNode)("div",r,[(0,o.createVNode)("button",{onClick:t[1]||(t[1]=(0,o.withModifiers)((function(e){return N.toggle()}),["prevent"])),id:"sidebar-button",class:"transition-color"},[h.open?((0,o.openBlock)(),(0,o.createBlock)("span",a,[i])):((0,o.openBlock)(),(0,o.createBlock)("span",c,[s])),d]),(0,o.createVNode)("div",{id:"sidebar-content",class:[h.open?"max-w-lg":"max-w-0"]},[(0,o.createVNode)("nav",l,[(0,o.createVNode)("ul",null,[((0,o.openBlock)(!0),(0,o.createBlock)(o.Fragment,null,(0,o.renderList)(h.menuItems,(function(t,n){return(0,o.openBlock)(),(0,o.createBlock)("li",{key:n},[e.route().current(t.route)?((0,o.openBlock)(),(0,o.createBlock)(k,{key:0,href:e.route(t.route),"aria-current":"page"},{default:(0,o.withCtx)((function(){return[(0,o.createTextVNode)((0,o.toDisplayString)(t.name),1)]})),_:2},1032,["href"])):((0,o.openBlock)(),(0,o.createBlock)(k,{key:1,href:e.route(t.route)},{default:(0,o.withCtx)((function(){return[(0,o.createTextVNode)((0,o.toDisplayString)(t.name),1)]})),_:2},1032,["href"]))])})),128)),e.authed?((0,o.openBlock)(),(0,o.createBlock)("li",u,[m])):(0,o.createCommentVNode)("",!0)])]),f],2)]),(0,o.createVNode)(o.Transition,{name:"fade"},{default:(0,o.withCtx)((function(){return[h.dimmer&&h.open?((0,o.openBlock)(),(0,o.createBlock)("div",{key:0,onClick:t[2]||(t[2]=function(e){return N.toggle()}),id:"sidebar-fade",class:"active:outline-none"})):(0,o.createCommentVNode)("",!0)]})),_:1})],2),(0,o.createVNode)("main",null,[(0,o.renderSlot)(e.$slots,"default")])],64)}},N=h}}]);