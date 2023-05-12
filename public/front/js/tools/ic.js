/**
 * A bunch of useful functions
 * Created by uadn-rk on 2/7/17.
 */
ic = (function(){
    "use strict";
    var appendContent = function(el, content) {
            if (typeof content === 'undefined') {
                el.insertAdjacentHTML('beforeend', '');
            } else if (content instanceof Element) {
                el.appendChild(content);
            } else if (typeof content === 'object') {
                for(var i in content){
                    appendContent(el, content[i]);
                }
            } else {
                el.insertAdjacentHTML('beforeend', content);
            }
        },
        el = function(tag, attrs, content) {
            var el = document.createElement(tag);
            for(var i in attrs) {
                if(attrs[i] instanceof Object || typeof attrs[i] === 'boolean') {
                    el[i] = attrs[i];
                } else {
                    el.setAttribute(i, attrs[i]);
                }
            }
            if(typeof content !== 'undefined') {
                appendContent(el, content);
            }
            return el;
        },
        discard = ( function(trash) {
            document.body && document.body.appendChild(trash);
            return function(elem) {
                if (elem instanceof NodeList || elem instanceof HTMLCollection) {
                    for(var i = 0; i < elem.length; ++i) {
                        ic.discard(elem[i]);
                    }
                } else if (elem instanceof HTMLElement) {
                    trash.appendChild(elem);
                    trash.innerHTML = '';
                } else {
                    throw new Error('Invalid element to discard: ' + typeof elem);
                }
            };
        } )( el('div', {style: 'display:none'}) ),
        notify = function(type, elem, pars) {
            pars = pars || {};
            type = type || 'warning';
            pars.title = pars.title || '';
            pars.text = pars.text || '';
            elem.innerHTML = '';
            elem.appendChild(el('div', {class: 'alert alert-block alert-' + type + ' fade in'}, [
                el('div', {
                    'data-dismiss':"alert",
                    class: 'close icon fa-window-close',
                    onclick: function(ev) { discard(ev.target.parentElement); }
                }),
                el('h4', {class: 'alert-heading'}, pars.title),
                el('div', {class: 'alert-content'}, pars.text)
            ]));
        },
        defaults = {ajaxUrl: '', alwaysCallback: false, async: true},
        readCookie = function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        },
        setCookie = function (name,value,days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        },
        eraseCookie = function (name) {
            document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        },
        mergeObjects = function myself (obj1, obj2) {
            for (var p in obj2) {
                if (obj2.hasOwnProperty(p) && typeof obj1[p] === 'object') {
                    myself(obj1[p], obj2[p]);
                } else {
                    obj1[p] = obj2[p];
                }
            }
            return obj1;
        };
    return {
        /**
         * Function creates element with predefined attributes, parameters and content
         * @param {string} tag HTML Tag to be created (e.g. div, span)
         * @param {object} attrs Attributes to be added to created element. If value is object - it applied as element property.
         * @param {array|string|null|Element} content Content to be added inside of the element. May be element or array of elements (elements or strings)
         */
        el: el,
        /**
         * Recursively merges second object into the first one
         * @param obj1
         * @param obj2
         * @returns {*}
         */
        mergeObjects: mergeObjects,
        /**
         * Removes element content and appends bootstrap notification to it
         * All properties are functions for easy access
         * @param {Element} elem Element wrapper for notification
         * @param {object} pars Notification arameters, may contain 'title' and 'text'
         */
        notif: {
            danger: notify.bind(null, 'danger'),
            success: notify.bind(null, 'success'),
            warning: notify.bind(null, 'warning')
        },
        /**
         * Dropdown generator
         * @param {Element} target
         * @param {array} pars Array of objects (items inside dropdown)
         * @param {object} opts Parameters of dropdown
         * @param {function} closeCall Callback that is called when dropdown was closed
         */
        drop: function(target, pars, opts, closeCall){
            var closeDrops = function (e){
                if(e && !(e.target.className !== 'drop-item' || e.keyCode === 27)){
                    return;
                }
                if(document.ic_openedDrops) {
                    var th = document.ic_openedDrops;
                    for (var i = 0, len = th.length; i < len; ++i) {
                        if (typeof th[i].element.closeDropdownClb === 'function') {
                            th[i].element.closeDropdownClb(th[i]);
                        }
                        th[i].element.remove();
                        th[i].parent.dropDownFired = false;
                        document.body.removeEventListener('click', this, false);
                        document.body.removeEventListener('keydown', this, false);
                    }
                    document.ic_openedDrops = [];
                }
            };
            if(target.dropDownFired){
                closeDrops();
            }else if(pars.length) {
                target.dropDownFired = true;
                opts = opts || {};
                opts.rightAllign = opts.rightAllign || false;
                if(typeof opts.autoclose === 'undefined'){
                    opts.autoclose =true;
                }
                target.style.position = 'relative';
                var styles = window.getComputedStyle(target),
                    drop = this.el('div', {class: 'drop'}),
                    i, len;
                closeDrops();
                drop.closeDropdownClb = closeCall || false;
                drop.style.width = opts.width || 'auto';
                drop.style[opts.rightAllign ? 'right' : 'left'] = 0;
                drop.style.top = Math.ceil(target.offsetHeight + parseFloat(styles['marginTop']) + parseFloat(styles['marginBottom'])) + 'px';
                if(typeof opts.marginTop !== 'undefined') {
                    drop.style.marginTop = opts.marginTop;
                }
                if(typeof opts.marginLeft !== 'undefined') {
                    drop.style.marginLeft = opts.marginLeft;
                }
                for (i = 0, len = pars.length; i < len; ++i) {
                    var el = {element: drop, params: pars[i], parent: target};
                    drop.appendChild(this.el('div', {class: 'drop-item', onclick: function(){
                        this.parent.dropDownFired = false;
                        this.params.action(this.element);
                        if(opts.autoclose){
                            closeDrops();
                        }
                    }.bind(el)}, el.params.name));
                }
                if(typeof document.ic_openedDrops === 'undefined'){
                    document.ic_openedDrops = [];
                }
                document.ic_openedDrops.push({element: drop, parent: target});
                target.appendChild(drop);
                document.body.addEventListener('click', closeDrops, false);
                document.body.addEventListener('keydown', closeDrops, false);
            }
        },
        /**
         * Tries to completely remove element from page and from memory
         * @param {Element} element
         */
        discard: discard,
        /**
         * Small facility to dynamically include javascript files from script
         * Protected from duplicate script inclusion
         * @param {string} src Source string, e.g. '/path/to/script.js'
         * @param {function} clb Callback function that supposed to be executed when script is loaded
         */
        importScript: (function(head){
            function loadError (oError){
                throw new URIError("The script " + oError.target.src + " is not accessible.");
            }
            var loadedScripts = [];
            return function(src, clb){
                if(loadedScripts.indexOf(src) === -1){
                    var scriptTag = ic.el('script', {type: 'text\/javascript', onerror: loadError});
                    scriptTag.onload = function(){
                        loadedScripts.push(src);
                        if(typeof clb === 'function'){
                            clb();
                        }
                    };
                    head.appendChild(scriptTag);
                    scriptTag.src = src;
                }else{
                    if(typeof clb === 'function'){
                        clb();
                    }
                }
            };
        })(document.head || document.getElementsByTagName("head")[0]),
        /**
         * Applies loader to page
         * @param {Element} target
         * @param {bool|undefined} load
         * @param {object|undefined} config
         */
        funLoader: function(target, load, config){
            if(!target instanceof HTMLElement){
                target = document.body;
            }
            if(typeof load ===  'undefined'){
                load = true;
                if(target.hasAttribute('fun-loader')){
                    this.funLoader(target, false);
                }
            }
            if(load){
                config = config || {};
                config = ic.mergeObjects(config, {message: 'Loading...', timeout: 2500});
                target.style.position = 'relative'; // needed to correctly append loader
                target.appendChild(ic.el('DIV', {
                    style: 'position:absolute;top:0;bottom:0;left:0;right:0;background:rgba(256,256,256,0.5);',
                    class: 'fun-loader-back',
                    'fun-loader': 1
                }, ic.el('DIV', {style: 'position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);'}, config.message)));
                target.setAttribute('fun-loader', 1);
            }else{
                if(target.hasAttribute('fun-loader')){
                    for(var i = 0; i < target.childNodes.length; ++i){
                        if(target.childNodes[i].className == 'fun-loader-back'){
                            ic.discard(target.childNodes[i]);
                        }
                    }
                    target.removeAttribute('fun-loader');
                }else{
                    // throw new Error('Attribute missing for funLoader element.');
                }
            }
        },
        defaults: defaults,
        /* ADDITIONAL COMMONS */
        happyAjax: function (params, sucClb, errClb, url) {
            $.ajax({
                url: url || defaults.ajaxUrl,
                async: defaults.async,
                method: 'POST',
                type: 'POST',  // For jQuery < 1.9
                dataType: 'json',
                data: params,
                beforeSend: function(request) {
                    request.setRequestHeader('usc', readCookie('usc'));
                },
                success: function(res, status, xhr) {
                    var token = xhr.getResponseHeader('usc');
                    if(typeof token === 'string' && token.length) {
                        //eraseCookie('usc');
                        setCookie('usc', token, 1);
                    }
                    if(typeof defaults.alwaysCallback === 'function'){
                        defaults.alwaysCallback();
                    }
                    if(typeof sucClb === 'function') {
                        sucClb(res);
                    }
                },
                error: function(res){
                    if(typeof defaults.alwaysCallback === 'function'){
                        defaults.alwaysCallback();
                    }
                    if(typeof errClb === 'function'){
                        errClb(res);
                    }else{
                        alert('Something serious happened: ' + res.responseText);
                    }
                }
            });
        },
        select: function(src, attrs, selected){
            var opts = [], a;
            selected = selected || null;
            for(var m = 0; m < src.length; ++m){
                a = src[m];
                if(selected !== null && selected === a.value){
                    a.selected = 'selected';
                }
                opts.push(el('option', a, a.name));
            }
            return el('select', attrs, opts);
        },
        pairToSrc: function(pairs){
            var a, toReturn = [];
            for(a in pairs){
                toReturn.push({value: a, name: pairs[a]});
            }
            return toReturn;
        },
        b64toBlob: function(b64Data, contentType, sliceSize) {
            contentType = contentType || '';
            sliceSize = sliceSize || 512;
            var byteCharacters = atob(b64Data);
            var byteArrays = [];
            for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                var slice = byteCharacters.slice(offset, offset + sliceSize);
                var byteNumbers = new Array(slice.length);
                for (var i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }
                var byteArray = new Uint8Array(byteNumbers);
                byteArrays.push(byteArray);
            }
            return new Blob(byteArrays, {type: contentType});
        },
        copyToClipboard: function(textToCopy) { // return promise
            // navigator clipboard api needs a secure context (https)
            if (navigator.clipboard && window.isSecureContext) {
                // navigator clipboard api method'
                return navigator.clipboard.writeText(textToCopy);
            } else {
                // text area method
                let textArea = document.createElement("textarea");
                textArea.value = textToCopy;
                // make the textarea out of viewport
                textArea.style.position = "fixed";
                textArea.style.left = "-999999px";
                textArea.style.top = "-999999px";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                return new Promise((res, rej) => {
                    // here the magic happens
                    document.execCommand('copy') ? res() : rej();
                    textArea.remove();
                });
            }
        }

    };
})();

