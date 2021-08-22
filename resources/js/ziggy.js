const Ziggy = {"url":"http:\/\/hallo-alexa.local","port":null,"defaults":{},"routes":{"nova.login":{"uri":"admin\/login","methods":["POST"]},"nova.logout":{"uri":"admin\/logout","methods":["GET","HEAD"]},"nova.password.request":{"uri":"admin\/password\/reset","methods":["GET","HEAD"]},"nova.password.email":{"uri":"admin\/password\/email","methods":["POST"]},"nova.password.reset":{"uri":"admin\/password\/reset\/{token}","methods":["GET","HEAD"]},"api.link.redirect":{"uri":"api\/link\/{link}","methods":["POST"],"bindings":{"link":"id"}},"home":{"uri":"\/","methods":["GET","HEAD"]},"test":{"uri":"test","methods":["GET","HEAD"]},"nova.index":{"uri":"admin","methods":["GET","HEAD"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
