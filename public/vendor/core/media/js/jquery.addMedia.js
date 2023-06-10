! function(e) {
    var t = {};

    function r(n) {
        if (t[n]) return t[n].exports;
        var a = t[n] = {
            i: n,
            l: !1,
            exports: {}
        };
        return e[n].call(a.exports, a, a.exports, r), a.l = !0, a.exports
    }
    r.m = e, r.c = t, r.d = function(e, t, n) {
        r.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: n
        })
    }, r.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, r.t = function(e, t) {
        if (1 & t && (e = r(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (r.r(n), Object.defineProperty(n, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var a in e) r.d(n, a, function(t) {
                return e[t]
            }.bind(null, a));
        return n
    }, r.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return r.d(t, "a", t), t
    }, r.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, r.p = "/", r(r.s = 128)
}({
    128: function(e, t, r) {
        e.exports = r(129)
    },
    129: function(e, t) {
        function r(e) {
            return (r = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }! function(e) {
            "use strict";
            var t = function(t, r) {
                this.options = r, e(t).rvMedia({
                    multiple: !0,
                    onSelectFiles: function(t, n) {
                        if (void 0 !== t) switch (n.data("editor")) {
                            case "summernote":
                                ! function(t, r) {
                                    if (0 === r.length) return;
                                    for (var n = t.data("target"), a = 0; a < r.length; a++)
                                        if ("youtube" === r[a].type || "video" === r[a].type) {
                                            var o = r[a].full_url;
                                            o = o.replace("watch?v=", "embed/"), e(n).summernote("pasteHTML", '<iframe width="420" height="315" src="' + o + '" frameborder="0" allowfullscreen></iframe>')
                                        } else "image" === r[a].type ? e(n).summernote("insertImage", r[a].full_url, r[a].basename) : e(n).summernote("pasteHTML", '<a href="' + r[a].full_url + '">' + r[a].full_url + "</a>")
                                }(n, t);
                                break;
                            case "wysihtml5":
                                ! function(e, t) {
                                    if (0 === t.length) return;
                                    for (var r = "", n = 0; n < t.length; n++)
                                        if ("youtube" === t[n].type || "video" === t[n].type) {
                                            var a = t[n].full_url;
                                            a = a.replace("watch?v=", "embed/"), r += '<iframe width="420" height="315" src="' + a + '" frameborder="0" allowfullscreen></iframe>'
                                        } else "image" === t[n].type ? r += '<img src="' + t[n].full_url + '">' : r += '<a href="' + t[n].full_url + '">' + t[n].full_url + "</a>";
                                    if (e.getValue().length > 0) {
                                        var o = e.getValue();
                                        e.composer.commands.exec("insertHTML", r), e.getValue() === o && e.setValue(e.getValue() + r)
                                    } else e.setValue(e.getValue() + r)
                                }(e(r.target).data("wysihtml5").editor, t);
                                break;
                            case "ckeditor":
                                ! function(t, r) {
                                    e.each(r, function(e, r) {
                                        var n = r.full_url,
                                            a = t.data("target").replace("#", "");
                                        "youtube" === r.type || "video" === r.type ? (n = n.replace("watch?v=", "embed/"), CKEDITOR.instances[a].insertHtml('<iframe width="420" height="315" src="' + n + '" frameborder="0" allowfullscreen></iframe>')) : "image" === r.type ? CKEDITOR.instances[a].insertHtml('<img src="' + n + '" alt="' + r.name + '" />') : CKEDITOR.instances[a].insertHtml('<a href="' + n + '">' + r.name + "</a>")
                                    })
                                }(n, t);
                                break;
                            case "tinymce":
                                ! function(t) {
                                    e.each(t, function(e, t) {
                                        var r = t.url,
                                            n = "";
                                        "youtube" === t.type || "video" === t.type ? (r = r.replace("watch?v=", "embed/"), n = '<iframe width="420" height="315" src="' + r + '" frameborder="0" allowfullscreen></iframe>') : n = "image" === t.type ? '<img src="' + r + '" alt="' + t.name + '" />' : '<a href="' + r + '">' + t.name + "</a>", tinymce.activeEditor.execCommand("mceInsertContent", !1, n)
                                    })
                                }(t)
                        }
                    }
                })
            };

            function n(n) {
                return this.each(function() {
                    var a = e(this),
                        o = a.data("bs.media"),
                        i = e.extend({}, a.data(), "object" === r(n) && n);
                    o || a.data("bs.media", o = new t(this, i))
                })
            }
            t.VERSION = "1.1.0", e.fn.addMedia = n, e.fn.addMedia.Constructor = t, e(window).on("load", function() {
                e('[data-type="rv-media"]').each(function() {
                    var t = e(this);
                    n.call(t, t.data())
                })
            })
        }(jQuery)
    }
});