! function(e) {
    var t = {};

    function a(i) {
        if (t[i]) return t[i].exports;
        var n = t[i] = {
            i: i,
            l: !1,
            exports: {}
        };
        return e[i].call(n.exports, n, n.exports, a), n.l = !0, n.exports
    }
    a.m = e, a.c = t, a.d = function(e, t, i) {
        a.o(e, t) || Object.defineProperty(e, t, {
            enumerable: !0,
            get: i
        })
    }, a.r = function(e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(e, "__esModule", {
            value: !0
        })
    }, a.t = function(e, t) {
        if (1 & t && (e = a(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var i = Object.create(null);
        if (a.r(i), Object.defineProperty(i, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e)
            for (var n in e) a.d(i, n, function(t) {
                return e[t]
            }.bind(null, n));
        return i
    }, a.n = function(e) {
        var t = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return a.d(t, "a", t), t
    }, a.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, a.p = "/", a(a.s = 127)
}({
    0: function(e, t, a) {
        "use strict";
        a.d(t, "a", function() {
            return r
        });
        var i = a(1);

        function n(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var r = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var t, a, r;
            return t = e, r = [{
                key: "getUrlParam",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
                    t || (t = window.location.search);
                    var a = new RegExp("(?:[?&]|&)" + e + "=([^&]+)", "i"),
                        i = t.match(a);
                    return i && i.length > 1 ? i[1] : null
                }
            }, {
                key: "asset",
                value: function(e) {
                    if ("//" === e.substring(0, 2) || "http://" === e.substring(0, 7) || "https://" === e.substring(0, 8)) return e;
                    var t = "/" !== RV_MEDIA_URL.base_url.substr(-1, 1) ? RV_MEDIA_URL.base_url + "/" : RV_MEDIA_URL.base_url;
                    return "/" === e.substring(0, 1) ? t + e.substring(1) : t + e
                }
            }, {
                key: "showAjaxLoading",
                value: function() {
                    (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : $(".rv-media-main")).addClass("on-loading").append($("#rv_media_loading").html())
                }
            }, {
                key: "hideAjaxLoading",
                value: function() {
                    (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : $(".rv-media-main")).removeClass("on-loading").find(".loading-wrapper").remove()
                }
            }, {
                key: "isOnAjaxLoading",
                value: function() {
                    return (arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : $(".rv-media-items")).hasClass("on-loading")
                }
            }, {
                key: "jsonEncode",
                value: function(e) {
                    return void 0 === e && (e = null), JSON.stringify(e)
                }
            }, {
                key: "jsonDecode",
                value: function(e, t) {
                    if (!e) return t;
                    if ("string" == typeof e) {
                        var a;
                        try {
                            a = $.parseJSON(e)
                        } catch (e) {
                            a = t
                        }
                        return a
                    }
                    return e
                }
            }, {
                key: "getRequestParams",
                value: function() {
                    return window.rvMedia.options && "modal" === window.rvMedia.options.open_in ? $.extend(!0, i.a.request_params, window.rvMedia.options || {}) : i.a.request_params
                }
            }, {
                key: "setSelectedFile",
                value: function(e) {
                    void 0 !== window.rvMedia.options ? window.rvMedia.options.selected_file_id = e : i.a.request_params.selected_file_id = e
                }
            }, {
                key: "getConfigs",
                value: function() {
                    return i.a
                }
            }, {
                key: "storeConfig",
                value: function() {
                    localStorage.setItem("MediaConfig", e.jsonEncode(i.a))
                }
            }, {
                key: "storeRecentItems",
                value: function() {
                    localStorage.setItem("RecentItems", e.jsonEncode(i.b))
                }
            }, {
                key: "addToRecent",
                value: function(e) {
                    e instanceof Array ? _.each(e, function(e) {
                        i.b.push(e)
                    }) : i.b.push(e)
                }
            }, {
                key: "getItems",
                value: function() {
                    var e = [];
                    return $(".js-media-list-title").each(function(t, a) {
                        var i = $(a),
                            n = i.data() || {};
                        n.index_key = i.index(), e.push(n)
                    }), e
                }
            }, {
                key: "getSelectedItems",
                value: function() {
                    var e = [];
                    return $(".js-media-list-title input[type=checkbox]:checked").each(function(t, a) {
                        var i = $(a).closest(".js-media-list-title"),
                            n = i.data() || {};
                        n.index_key = i.index(), e.push(n)
                    }), e
                }
            }, {
                key: "getSelectedFiles",
                value: function() {
                    var e = [];
                    return $(".js-media-list-title[data-context=file] input[type=checkbox]:checked").each(function(t, a) {
                        var i = $(a).closest(".js-media-list-title"),
                            n = i.data() || {};
                        n.index_key = i.index(), e.push(n)
                    }), e
                }
            }, {
                key: "getSelectedFolder",
                value: function() {
                    var e = [];
                    return $(".js-media-list-title[data-context=folder] input[type=checkbox]:checked").each(function(t, a) {
                        var i = $(a).closest(".js-media-list-title"),
                            n = i.data() || {};
                        n.index_key = i.index(), e.push(n)
                    }), e
                }
            }, {
                key: "isUseInModal",
                value: function() {
                    return "select-files" === e.getUrlParam("media-action") || window.rvMedia && window.rvMedia.options && "modal" === window.rvMedia.options.open_in
                }
            }, {
                key: "resetPagination",
                value: function() {
                    RV_MEDIA_CONFIG.pagination = {
                        paged: 1,
                        posts_per_page: 40,
                        in_process_get_media: !1,
                        has_more: !0
                    }
                }
            }], (a = null) && n(t.prototype, a), r && n(t, r), e
        }()
    },
    1: function(e, t, a) {
        "use strict";
        a.d(t, "a", function() {
            return i
        }), a.d(t, "b", function() {
            return r
        });
        var i = $.parseJSON(localStorage.getItem("MediaConfig")) || {},
            n = {
                app_key: "483a0xyzytz1242c0d520426e8ba366c530c3d9d3xd",
                request_params: {
                    view_type: "tiles",
                    filter: "everything",
                    view_in: "all_media",
                    search: "",
                    sort_by: "created_at-desc",
                    folder_id: 0
                },
                hide_details_pane: !1,
                icons: {
                    folder: "fa fa-folder"
                },
                actions_list: {
                    basic: [{
                        icon: "fa fa-eye",
                        name: "Preview",
                        action: "preview",
                        order: 0,
                        class: "rv-action-preview"
                    }],
                    file: [{
                        icon: "fa fa-link",
                        name: "Copy link",
                        action: "copy_link",
                        order: 0,
                        class: "rv-action-copy-link"
                    }, {
                        icon: "far fa-edit",
                        name: "Rename",
                        action: "rename",
                        order: 1,
                        class: "rv-action-rename"
                    }, {
                        icon: "fa fa-copy",
                        name: "Make a copy",
                        action: "make_copy",
                        order: 2,
                        class: "rv-action-make-copy"
                    }],
                    user: [{
                        icon: "fa fa-star",
                        name: "Favorite",
                        action: "favorite",
                        order: 2,
                        class: "rv-action-favorite"
                    }, {
                        icon: "fa fa-star",
                        name: "Remove favorite",
                        action: "remove_favorite",
                        order: 3,
                        class: "rv-action-favorite"
                    }],
                    other: [{
                        icon: "fa fa-download",
                        name: "Download",
                        action: "download",
                        order: 0,
                        class: "rv-action-download"
                    }, {
                        icon: "fa fa-trash",
                        name: "Move to trash",
                        action: "trash",
                        order: 1,
                        class: "rv-action-trash"
                    }, {
                        icon: "fa fa-eraser",
                        name: "Delete permanently",
                        action: "delete",
                        order: 2,
                        class: "rv-action-delete"
                    }, {
                        icon: "fa fa-undo",
                        name: "Restore",
                        action: "restore",
                        order: 3,
                        class: "rv-action-restore"
                    }]
                },
                denied_download: ["youtube"]
            };
        i.app_key && i.app_key === n.app_key || (i = n);
        var r = $.parseJSON(localStorage.getItem("RecentItems")) || []
    },
    127: function(e, t, a) {
        e.exports = a(291)
    },
    23: function(e, t, a) {
        "use strict";
        a.r(t), a.d(t, "EditorService", function() {
            return s
        });
        var i = a(0),
            n = a(1);

        function r(e, t) {
            if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
        }

        function o(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var s = function() {
                function e() {
                    r(this, e)
                }
                var t, a, n;
                return t = e, n = [{
                    key: "editorSelectFile",
                    value: function(e) {
                        var t = i.a.getUrlParam("CKEditor") || i.a.getUrlParam("CKEditorFuncNum");
                        if (window.opener && t) {
                            var a = _.first(e);
                            window.opener.CKEDITOR.tools.callFunction(i.a.getUrlParam("CKEditorFuncNum"), a.url), window.opener && window.close()
                        }
                    }
                }], (a = null) && o(t.prototype, a), n && o(t, n), e
            }(),
            l = function e(t, a) {
                r(this, e), window.rvMedia = window.rvMedia || {};
                var o = $("body");
                a = $.extend(!0, {
                    multiple: !0,
                    type: "*",
                    onSelectFiles: function(e, t) {}
                }, a);
                var s = function(e) {
                    e.preventDefault();
                    var t = $(e.currentTarget);
                    $("#rv_media_modal").modal(), window.rvMedia.options = a, window.rvMedia.options.open_in = "modal", window.rvMedia.$el = t, n.a.request_params.filter = "everything", i.a.storeConfig();
                    var r = window.rvMedia.$el.data("rv-media");
                    void 0 !== r && r.length > 0 && (r = r[0], window.rvMedia.options = $.extend(!0, window.rvMedia.options, r || {}), void 0 !== r.selected_file_id ? window.rvMedia.options.is_popup = !0 : void 0 !== window.rvMedia.options.is_popup && (window.rvMedia.options.is_popup = void 0)), 0 === $("#rv_media_body .rv-media-container").length ? $("#rv_media_body").load(RV_MEDIA_URL.popup, function(e) {
                        e.error && alert(e.message), $("#rv_media_body").removeClass("media-modal-loading").closest(".modal-content").removeClass("bb-loading"), $(document).find(".rv-media-container .js-change-action[data-type=refresh]").trigger("click")
                    }) : $(document).find(".rv-media-container .js-change-action[data-type=refresh]").trigger("click")
                };
                "string" == typeof t ? o.off("click", t).on("click", t, s) : t.off("click").on("click", s)
            };
        window.RvMediaStandAlone = l, $(".js-insert-to-editor").off("click").on("click", function(e) {
            e.preventDefault();
            var t = i.a.getSelectedFiles();
            _.size(t) > 0 && s.editorSelectFile(t)
        }), $.fn.rvMedia = function(e) {
            var t = $(this);
            n.a.request_params.filter = "everything", "trash" === n.a.request_params.view_in ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), i.a.storeConfig(), new l(t, e)
        }
    },
    291: function(e, t, a) {
        "use strict";
        a.r(t);
        var i = a(1),
            n = a(0);

        function r(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var o = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var t, a, i;
            return t = e, i = [{
                key: "showMessage",
                value: function(e, t) {
                    toastr.options = {
                        closeButton: !0,
                        progressBar: !0,
                        positionClass: "toast-bottom-right",
                        onclick: null,
                        showDuration: 1e3,
                        hideDuration: 1e3,
                        timeOut: 1e4,
                        extendedTimeOut: 1e3,
                        showEasing: "swing",
                        hideEasing: "linear",
                        showMethod: "fadeIn",
                        hideMethod: "fadeOut"
                    };
                    var a = "";
                    switch (e) {
                        case "error":
                            a = RV_MEDIA_CONFIG.translations.message.error_header;
                            break;
                        case "success":
                            a = RV_MEDIA_CONFIG.translations.message.success_header
                    }
                    toastr[e](t, a)
                }
            }, {
                key: "handleError",
                value: function(t) {
                    void 0 === t.responseJSON || _.isArray(t.errors) ? void 0 !== t.responseJSON ? void 0 !== t.responseJSON.errors ? 422 === t.status && e.handleValidationError(t.responseJSON.errors) : void 0 !== t.responseJSON.message ? e.showMessage("error", t.responseJSON.message) : $.each(t.responseJSON, function(t, a) {
                        $.each(a, function(t, a) {
                            e.showMessage("error", a)
                        })
                    }) : e.showMessage("error", t.statusText) : e.handleValidationError(t.responseJSON.errors)
                }
            }, {
                key: "handleValidationError",
                value: function(t) {
                    var a = "";
                    $.each(t, function(e, t) {
                        a += t + "<br />", $('*[name="' + e + '"]').addClass("field-has-error"), $('*[name$="[' + e + ']"]').addClass("field-has-error")
                    }), e.showMessage("error", a)
                }
            }], (a = null) && r(t.prototype, a), i && r(t, i), e
        }();

        function s(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var l = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var t, a, r;
            return t = e, r = [{
                key: "handleDropdown",
                value: function() {
                    var t = _.size(n.a.getSelectedItems());
                    e.renderActions(), t > 0 ? $(".rv-dropdown-actions").removeClass("disabled") : $(".rv-dropdown-actions").addClass("disabled")
                }
            }, {
                key: "handlePreview",
                value: function() {
                    var e = [];
                    _.each(n.a.getSelectedFiles(), function(t) {
                        _.includes(["image", "youtube", "pdf", "text", "video"], t.type) && (e.push({
                            src: t.url
                        }), i.b.push(t.id))
                    }), _.size(e) > 0 ? ($.fancybox.open(e), n.a.storeRecentItems()) : this.handleGlobalAction("download")
                }
            }, {
                key: "handleCopyLink",
                value: function() {
                    var e = "";
                    _.each(n.a.getSelectedFiles(), function(t) {
                        _.isEmpty(e) || (e += "\n"), e += t.full_url
                    });
                    var t = $(".js-rv-clipboard-temp");
                    t.data("clipboard-text", e), new Clipboard(".js-rv-clipboard-temp", {
                        text: function() {
                            return e
                        }
                    }), o.showMessage("success", RV_MEDIA_CONFIG.translations.clipboard.success, RV_MEDIA_CONFIG.translations.message.success_header), t.trigger("click")
                }
            }, {
                key: "handleGlobalAction",
                value: function(t, a) {
                    var i = [];
                    switch (_.each(n.a.getSelectedItems(), function(e) {
                        i.push({
                            is_folder: e.is_folder,
                            id: e.id,
                            full_url: e.full_url
                        })
                    }), t) {
                        case "rename":
                            $("#modal_rename_items").modal("show").find("form.rv-form").data("action", t);
                            break;
                        case "copy_link":
                            e.handleCopyLink();
                            break;
                        case "preview":
                            e.handlePreview();
                            break;
                        case "trash":
                            $("#modal_trash_items").modal("show").find("form.rv-form").data("action", t);
                            break;
                        case "delete":
                            $("#modal_delete_items").modal("show").find("form.rv-form").data("action", t);
                            break;
                        case "empty_trash":
                            $("#modal_empty_trash").modal("show").find("form.rv-form").data("action", t);
                            break;
                        case "download":
                            var r = RV_MEDIA_URL.download,
                                s = 0;
                            _.each(n.a.getSelectedItems(), function(e) {
                                _.includes(n.a.getConfigs().denied_download, e.mime_type) || (r += (0 === s ? "?" : "&") + "selected[" + s + "][is_folder]=" + e.is_folder + "&selected[" + s + "][id]=" + e.id, s++)
                            }), r !== RV_MEDIA_URL.download ? window.open(r, "_blank") : o.showMessage("error", RV_MEDIA_CONFIG.translations.download.error, RV_MEDIA_CONFIG.translations.message.error_header);
                            break;
                        default:
                            e.processAction({
                                selected: i,
                                action: t
                            }, a)
                    }
                }
            }, {
                key: "processAction",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : null;
                    $.ajax({
                        url: RV_MEDIA_URL.global_actions,
                        type: "POST",
                        data: e,
                        dataType: "json",
                        beforeSend: function() {
                            n.a.showAjaxLoading()
                        },
                        success: function(e) {
                            n.a.resetPagination(), e.error ? o.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header) : o.showMessage("success", e.message, RV_MEDIA_CONFIG.translations.message.success_header), t && t(e)
                        },
                        complete: function() {
                            n.a.hideAjaxLoading()
                        },
                        error: function(e) {
                            o.handleError(e)
                        }
                    })
                }
            }, {
                key: "renderRenameItems",
                value: function() {
                    var e = $("#rv_media_rename_item").html(),
                        t = $("#modal_rename_items .rename-items").empty();
                    _.each(n.a.getSelectedItems(), function(a) {
                        var i = e.replace(/__icon__/gi, a.icon || "fa fa-file").replace(/__placeholder__/gi, "Input file name").replace(/__value__/gi, a.name),
                            n = $(i);
                        n.data("id", a.id), n.data("is_folder", a.is_folder), n.data("name", a.name), t.append(n)
                    })
                }
            }, {
                key: "renderActions",
                value: function() {
                    var e = n.a.getSelectedFolder().length > 0,
                        t = $("#rv_action_item").html(),
                        a = 0,
                        i = $(".rv-dropdown-actions .dropdown-menu");
                    i.empty();
                    var r = $.extend({}, !0, n.a.getConfigs().actions_list);
                    e && (r.basic = _.reject(r.basic, function(e) {
                        return "preview" === e.action
                    }), r.file = _.reject(r.file, function(e) {
                        return "copy_link" === e.action
                    }), _.includes(RV_MEDIA_CONFIG.permissions, "folders.create") || (r.file = _.reject(r.file, function(e) {
                        return "make_copy" === e.action
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.edit") || (r.file = _.reject(r.file, function(e) {
                        return _.includes(["rename"], e.action)
                    }), r.user = _.reject(r.user, function(e) {
                        return _.includes(["rename"], e.action)
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.trash") || (r.other = _.reject(r.other, function(e) {
                        return _.includes(["trash", "restore"], e.action)
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.delete") || (r.other = _.reject(r.other, function(e) {
                        return _.includes(["delete"], e.action)
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "folders.favorite") || (r.other = _.reject(r.other, function(e) {
                        return _.includes(["favorite", "remove_favorite"], e.action)
                    })));
                    var o = n.a.getSelectedFiles(),
                        s = !1;
                    _.each(o, function(e) {
                        _.includes(["image", "youtube", "pdf", "text", "video"], e.type) && (s = !0)
                    }), s || (r.basic = _.reject(r.basic, function(e) {
                        return "preview" === e.action
                    })), o.length > 0 && (_.includes(RV_MEDIA_CONFIG.permissions, "files.create") || (r.file = _.reject(r.file, function(e) {
                        return "make_copy" === e.action
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "files.edit") || (r.file = _.reject(r.file, function(e) {
                        return _.includes(["rename"], e.action)
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "files.trash") || (r.other = _.reject(r.other, function(e) {
                        return _.includes(["trash", "restore"], e.action)
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "files.delete") || (r.other = _.reject(r.other, function(e) {
                        return _.includes(["delete"], e.action)
                    })), _.includes(RV_MEDIA_CONFIG.permissions, "files.favorite") || (r.other = _.reject(r.other, function(e) {
                        return _.includes(["favorite", "remove_favorite"], e.action)
                    }))), _.each(r, function(e, r) {
                        _.each(e, function(e, o) {
                            var s = !1;
                            switch (n.a.getRequestParams().view_in) {
                                case "all_media":
                                    _.includes(["remove_favorite", "delete", "restore"], e.action) && (s = !0);
                                    break;
                                case "recent":
                                    _.includes(["remove_favorite", "delete", "restore", "make_copy"], e.action) && (s = !0);
                                    break;
                                case "favorites":
                                    _.includes(["favorite", "delete", "restore", "make_copy"], e.action) && (s = !0);
                                    break;
                                case "trash":
                                    _.includes(["preview", "delete", "restore", "rename", "download"], e.action) || (s = !0)
                            }
                            if (!s) {
                                var l = t.replace(/__action__/gi, e.action || "").replace(/__icon__/gi, e.icon || "").replace(/__name__/gi, RV_MEDIA_CONFIG.translations.actions_list[r][e.action] || e.name);
                                !o && a && (l = '<li role="separator" class="divider"></li>' + l), i.append(l)
                            }
                        }), e.length > 0 && a++
                    })
                }
            }], (a = null) && s(t.prototype, a), r && s(t, r), e
        }();

        function d(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var c = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e)
            }
            var t, a, i;
            return t = e, i = [{
                key: "initContext",
                value: function() {
                    jQuery().contextMenu && ($.contextMenu({
                        selector: '.js-context-menu[data-context="file"]',
                        build: function() {
                            return {
                                items: e._fileContextMenu()
                            }
                        }
                    }), $.contextMenu({
                        selector: '.js-context-menu[data-context="folder"]',
                        build: function() {
                            return {
                                items: e._folderContextMenu()
                            }
                        }
                    }))
                }
            }, {
                key: "_fileContextMenu",
                value: function() {
                    var e = {
                        preview: {
                            name: "Preview",
                            icon: function(e, t, a, i) {
                                return t.html('<i class="fa fa-eye" aria-hidden="true"></i> ' + i.name), "context-menu-icon-updated"
                            },
                            callback: function() {
                                l.handlePreview()
                            }
                        }
                    };
                    _.each(n.a.getConfigs().actions_list, function(t, a) {
                        _.each(t, function(t) {
                            e[t.action] = {
                                name: t.name,
                                icon: function(e, i, n, r) {
                                    return i.html('<i class="' + t.icon + '" aria-hidden="true"></i> ' + (RV_MEDIA_CONFIG.translations.actions_list[a][t.action] || r.name)), "context-menu-icon-updated"
                                },
                                callback: function() {
                                    $('.js-files-action[data-action="' + t.action + '"]').trigger("click")
                                }
                            }
                        })
                    });
                    var t = [];
                    switch (n.a.getRequestParams().view_in) {
                        case "all_media":
                            t = ["remove_favorite", "delete", "restore"];
                            break;
                        case "recent":
                            t = ["remove_favorite", "delete", "restore", "make_copy"];
                            break;
                        case "favorites":
                            t = ["favorite", "delete", "restore", "make_copy"];
                            break;
                        case "trash":
                            e = {
                                preview: e.preview,
                                rename: e.rename,
                                download: e.download,
                                delete: e.delete,
                                restore: e.restore
                            }
                    }
                    _.each(t, function(t) {
                        e[t] = void 0
                    }), n.a.getSelectedFolder().length > 0 && (e.preview = void 0, e.copy_link = void 0, _.includes(RV_MEDIA_CONFIG.permissions, "folders.create") || (e.make_copy = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.edit") || (e.rename = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.trash") || (e.trash = void 0, e.restore = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.delete") || (e.delete = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "folders.favorite") || (e.favorite = void 0, e.remove_favorite = void 0));
                    var a = n.a.getSelectedFiles();
                    a.length > 0 && (_.includes(RV_MEDIA_CONFIG.permissions, "files.create") || (e.make_copy = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.edit") || (e.rename = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.trash") || (e.trash = void 0, e.restore = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.delete") || (e.delete = void 0), _.includes(RV_MEDIA_CONFIG.permissions, "files.favorite") || (e.favorite = void 0, e.remove_favorite = void 0));
                    var i = !1;
                    return _.each(a, function(e) {
                        _.includes(["image", "youtube", "pdf", "text", "video"], e.type) && (i = !0)
                    }), i || (e.preview = void 0), e
                }
            }, {
                key: "_folderContextMenu",
                value: function() {
                    var t = e._fileContextMenu();
                    return t.preview = void 0, t.copy_link = void 0, t
                }
            }, {
                key: "destroyContext",
                value: function() {
                    jQuery().contextMenu && $.contextMenu("destroy")
                }
            }], (a = null) && d(t.prototype, a), i && d(t, i), e
        }();

        function u(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var f = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.group = {}, this.group.list = $("#rv_media_items_list").html(), this.group.tiles = $("#rv_media_items_tiles").html(), this.item = {}, this.item.list = $("#rv_media_items_list_element").html(), this.item.tiles = $("#rv_media_items_tiles_element").html(), this.$groupContainer = $(".rv-media-items")
            }
            var t, a, i;
            return t = e, (a = [{
                key: "renderData",
                value: function(e) {
                    var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                        a = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
                        i = this,
                        r = n.a.getConfigs(),
                        o = i.group[n.a.getRequestParams().view_type],
                        s = n.a.getRequestParams().view_in;
                    _.includes(["all_media", "public", "trash", "favorites", "recent"], s) || (s = "all_media"), o = o.replace(/__noItemIcon__/gi, RV_MEDIA_CONFIG.translations.no_item[s].icon || "").replace(/__noItemTitle__/gi, RV_MEDIA_CONFIG.translations.no_item[s].title || "").replace(/__noItemMessage__/gi, RV_MEDIA_CONFIG.translations.no_item[s].message || "");
                    var d = $(o),
                        c = d.find("ul");
                    a && this.$groupContainer.find(".rv-media-grid ul").length > 0 && (c = this.$groupContainer.find(".rv-media-grid ul")), _.size(e.folders) > 0 || _.size(e.files) > 0 || a ? $(".rv-media-items").addClass("has-items") : $(".rv-media-items").removeClass("has-items"), _.forEach(e.folders, function(e) {
                        var t = i.item[n.a.getRequestParams().view_type];
                        t = t.replace(/__type__/gi, "folder").replace(/__id__/gi, e.id).replace(/__name__/gi, e.name || "").replace(/__size__/gi, "").replace(/__date__/gi, e.created_at || "").replace(/__thumb__/gi, '<i class="fa fa-folder"></i>');
                        var a = $(t);
                        _.forEach(e, function(e, t) {
                            a.data(t, e)
                        }), a.data("is_folder", !0), a.data("icon", r.icons.folder), c.append(a)
                    }), _.forEach(e.files, function(e) {
                        var t = i.item[n.a.getRequestParams().view_type];
                        if (t = t.replace(/__type__/gi, "file").replace(/__id__/gi, e.id).replace(/__name__/gi, e.name || "").replace(/__size__/gi, e.size || "").replace(/__date__/gi, e.created_at || ""), "list" === n.a.getRequestParams().view_type) t = t.replace(/__thumb__/gi, '<i class="' + e.icon + '"></i>');
                        else switch (e.mime_type) {
                            case "youtube":
                                t = t.replace(/__thumb__/gi, '<img src="' + e.options.thumb + '" alt="' + e.name + '">');
                                break;
                            default:
                                t = t.replace(/__thumb__/gi, e.thumb ? '<img src="' + e.thumb + '" alt="' + e.name + '">' : '<i class="' + e.icon + '"></i>')
                        }
                        var a = $(t);
                        a.data("is_folder", !1), _.forEach(e, function(e, t) {
                            a.data(t, e)
                        }), c.append(a)
                    }), !1 !== t && i.$groupContainer.empty(), a && this.$groupContainer.find(".rv-media-grid ul").length > 0 || i.$groupContainer.append(d), i.$groupContainer.find(".loading-wrapper").remove(), l.handleDropdown(), $(".js-media-list-title[data-id=" + e.selected_file_id + "]").trigger("click")
                }
            }]) && u(t.prototype, a), i && u(t, i), e
        }();

        function p(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var m = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.$detailsWrapper = $(".rv-media-main .rv-media-details"), this.descriptionItemTemplate = '<div class="rv-media-name"><p>__title__</p>__url__</div>', this.onlyFields = ["name", "full_url", "size", "mime_type", "created_at", "updated_at", "nothing_selected"], this.externalTypes = ["youtube", "vimeo", "metacafe", "dailymotion", "vine", "instagram"]
            }
            var t, a, i;
            return t = e, (a = [{
                key: "renderData",
                value: function(e) {
                    var t = this,
                        a = this,
                        i = "image" === e.type ? '<img src="' + e.full_url + '" alt="' + e.name + '">' : "youtube" === e.mime_type ? '<img src="' + e.options.thumb + '" alt="' + e.name + '">' : '<i class="' + e.icon + '"></i>',
                        r = "",
                        o = !1;
                    _.forEach(e, function(t, i) {
                        _.includes(a.onlyFields, i) && (!_.includes(a.externalTypes, e.type) || _.includes(a.externalTypes, e.type) && !_.includes(["size", "mime_type"], i)) && (r += a.descriptionItemTemplate.replace(/__title__/gi, RV_MEDIA_CONFIG.translations[i]).replace(/__url__/gi, t ? "full_url" === i ? '<div class="input-group"><input id="file_details_url" type="text" value="' + t + '" class="form-control"><span class="input-group-prepend"><button class="btn btn-default js-btn-copy-to-clipboard" type="button" data-clipboard-target="#file_details_url" title="Copied"><img class="clippy" src="' + n.a.asset("/vendor/core/media/images/clippy.svg") + '" width="13" alt="Copy to clipboard"></button></span></div>' : '<span title="' + t + '">' + t + "</span>" : ""), "full_url" === i && (o = !0))
                    }), a.$detailsWrapper.find(".rv-media-thumbnail").html(i), a.$detailsWrapper.find(".rv-media-description").html(r), o && (new Clipboard(".js-btn-copy-to-clipboard"), $(".js-btn-copy-to-clipboard").tooltip().on("mouseenter", function() {
                        $(t).tooltip("hide")
                    }).on("mouseleave", function() {
                        $(t).tooltip("hide")
                    }))
                }
            }]) && p(t.prototype, a), i && p(t, i), e
        }();

        function v(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var h = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.MediaList = new f, this.MediaDetails = new m, this.breadcrumbTemplate = $("#rv_media_breadcrumb_item").html()
            }
            var t, a, r;
            return t = e, r = [{
                key: "refreshFilter",
                value: function() {
                    var e = $(".rv-media-container"),
                        t = n.a.getRequestParams().view_in;
                    "all_media" !== t && 0 === parseInt(n.a.getRequestParams().folder_id) ? ($('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').addClass("disabled"), e.attr("data-allow-upload", "false")) : ($('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').removeClass("disabled"), e.attr("data-allow-upload", "true")), $(".rv-media-actions .btn.js-rv-media-change-filter-group").removeClass("disabled");
                    var a = $('.rv-media-actions .btn[data-action="empty_trash"]');
                    "trash" === t ? (a.removeClass("hidden").removeClass("disabled"), _.size(n.a.getItems()) || a.addClass("hidden").addClass("disabled")) : a.addClass("hidden"), c.destroyContext(), c.initContext(), e.attr("data-view-in", t)
                }
            }], (a = [{
                key: "getMedia",
                value: function() {
                    var t = arguments.length > 0 && void 0 !== arguments[0] && arguments[0],
                        a = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                        r = arguments.length > 2 && void 0 !== arguments[2] && arguments[2];
                    if (void 0 !== RV_MEDIA_CONFIG.pagination) {
                        if (RV_MEDIA_CONFIG.pagination.in_process_get_media) return;
                        RV_MEDIA_CONFIG.pagination.in_process_get_media = !0
                    }
                    var s = this;
                    s.getFileDetails({
                        icon: "far fa-image",
                        nothing_selected: ""
                    });
                    var d = n.a.getRequestParams();
                    "recent" === d.view_in && (d.recent_items = i.b), d.is_popup = !0 === a || void 0, d.onSelectFiles = void 0, void 0 !== d.search && "" != d.search && void 0 !== d.selected_file_id && (d.selected_file_id = void 0), d.load_more_file = r, void 0 !== RV_MEDIA_CONFIG.pagination && (d.paged = RV_MEDIA_CONFIG.pagination.paged, d.posts_per_page = RV_MEDIA_CONFIG.pagination.posts_per_page), $.ajax({
                        url: RV_MEDIA_URL.get_media,
                        type: "GET",
                        data: d,
                        dataType: "json",
                        beforeSend: function() {
                            n.a.showAjaxLoading()
                        },
                        success: function(a) {
                            s.MediaList.renderData(a.data, t, r), s.fetchQuota(), s.renderBreadcrumbs(a.data.breadcrumbs), e.refreshFilter(), l.renderActions(), void 0 !== RV_MEDIA_CONFIG.pagination && (void 0 !== RV_MEDIA_CONFIG.pagination.paged && (RV_MEDIA_CONFIG.pagination.paged += 1), void 0 !== RV_MEDIA_CONFIG.pagination.in_process_get_media && (RV_MEDIA_CONFIG.pagination.in_process_get_media = !1), void 0 !== RV_MEDIA_CONFIG.pagination.posts_per_page && a.data.files.length < RV_MEDIA_CONFIG.pagination.posts_per_page && void 0 !== RV_MEDIA_CONFIG.pagination.has_more && (RV_MEDIA_CONFIG.pagination.has_more = !1))
                        },
                        complete: function() {
                            n.a.hideAjaxLoading()
                        },
                        error: function(e) {
                            o.handleError(e)
                        }
                    })
                }
            }, {
                key: "getFileDetails",
                value: function(e) {
                    this.MediaDetails.renderData(e)
                }
            }, {
                key: "fetchQuota",
                value: function() {
                    $.ajax({
                        url: RV_MEDIA_URL.get_quota,
                        type: "GET",
                        dataType: "json",
                        success: function(e) {
                            var t = e.data;
                            $(".rv-media-aside-bottom .used-analytics span").html(t.used + " / " + t.quota), $(".rv-media-aside-bottom .progress-bar").css({
                                width: t.percent + "%"
                            })
                        },
                        error: function(e) {
                            o.handleError(e)
                        }
                    })
                }
            }, {
                key: "renderBreadcrumbs",
                value: function(e) {
                    var t = this,
                        a = $(".rv-media-breadcrumb .breadcrumb");
                    a.find("li").remove(), _.each(e, function(e) {
                        var i = t.breadcrumbTemplate;
                        i = i.replace(/__name__/gi, e.name || "").replace(/__icon__/gi, e.icon ? '<i class="' + e.icon + '"></i>' : "").replace(/__folderId__/gi, e.id || 0), a.append($(i))
                    }), $(".rv-media-container").attr("data-breadcrumb-count", _.size(e))
                }
            }]) && v(t.prototype, a), r && v(t, r), e
        }();

        function g(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var y = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.MediaService = new h, $("body").on("shown.bs.modal", "#modal_add_folder", function(e) {
                    $(e.currentTarget).find(".form-add-folder input[type=text]").focus()
                })
            }
            var t, a, r;
            return t = e, r = [{
                key: "closeModal",
                value: function() {
                    $(document).find("#modal_add_folder").modal("hide")
                }
            }], (a = [{
                key: "create",
                value: function(t) {
                    var a = this;
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        }
                    }), $.ajax({
                        url: RV_MEDIA_URL.create_folder,
                        type: "POST",
                        data: {
                            parent_id: n.a.getRequestParams().folder_id,
                            name: t
                        },
                        dataType: "json",
                        beforeSend: function() {
                            n.a.showAjaxLoading()
                        },
                        success: function(t) {
                            t.error ? o.showMessage("error", t.message, RV_MEDIA_CONFIG.translations.message.error_header) : (o.showMessage("success", t.message, RV_MEDIA_CONFIG.translations.message.success_header), n.a.resetPagination(), a.MediaService.getMedia(!0), e.closeModal())
                        },
                        complete: function() {
                            n.a.hideAjaxLoading()
                        },
                        error: function(e) {
                            o.handleError(e)
                        }
                    })
                }
            }, {
                key: "changeFolder",
                value: function(e) {
                    i.a.request_params.folder_id = e, n.a.storeConfig(), this.MediaService.getMedia(!0)
                }
            }]) && g(t.prototype, a), r && g(t, r), e
        }();

        function b(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var w = function() {
                function e() {
                    ! function(e, t) {
                        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                    }(this, e), this.$body = $("body"), this.dropZone = null, this.uploadUrl = RV_MEDIA_URL.upload_file, this.uploadProgressBox = $(".rv-upload-progress"), this.uploadProgressContainer = $(".rv-upload-progress .rv-upload-progress-table"), this.uploadProgressTemplate = $("#rv_media_upload_progress_item").html(), this.totalQueued = 1, this.MediaService = new h, this.totalError = 0
                }
                var t, a, i;
                return t = e, i = [{
                    key: "formatFileSize",
                    value: function(e) {
                        var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1] ? 1e3 : 1024;
                        if (Math.abs(e) < t) return e + " B";
                        var a = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
                            i = -1;
                        do {
                            e /= t, ++i
                        } while (Math.abs(e) >= t && i < a.length - 1);
                        return e.toFixed(1) + " " + a[i]
                    }
                }], (a = [{
                    key: "init",
                    value: function() {
                        _.includes(RV_MEDIA_CONFIG.permissions, "files.create") && $(".rv-media-items").length > 0 && this.setupDropZone(), this.handleEvents()
                    }
                }, {
                    key: "setupDropZone",
                    value: function() {
                        var e = this;
                        e.dropZone = new Dropzone(document.querySelector(".rv-media-items"), {
                            url: e.uploadUrl,
                            thumbnailWidth: !1,
                            thumbnailHeight: !1,
                            parallelUploads: 1,
                            autoQueue: !0,
                            clickable: ".js-dropzone-upload",
                            previewTemplate: !1,
                            previewsContainer: !1,
                            uploadMultiple: !0,
                            sending: function(e, t, a) {
                                a.append("_token", $('meta[name="csrf-token"]').attr("content")), a.append("folder_id", n.a.getRequestParams().folder_id), a.append("view_in", n.a.getRequestParams().view_in)
                            }
                        }), e.dropZone.on("addedfile", function(t) {
                            t.index = e.totalQueued, e.totalQueued++
                        }), e.dropZone.on("sending", function(t) {
                            e.initProgress(t.name, t.size)
                        }), e.dropZone.on("success", function(e) {}), e.dropZone.on("complete", function(t) {
                            e.changeProgressStatus(t)
                        }), e.dropZone.on("queuecomplete", function() {
                            n.a.resetPagination(), e.MediaService.getMedia(!0), 0 === e.totalError && setTimeout(function() {
                                $(".rv-upload-progress .close-pane").trigger("click")
                            }, 5e3)
                        })
                    }
                }, {
                    key: "handleEvents",
                    value: function() {
                        var e = this;
                        e.$body.off("click", ".rv-upload-progress .close-pane").on("click", ".rv-upload-progress .close-pane", function(t) {
                            t.preventDefault(), $(".rv-upload-progress").addClass("hide-the-pane"), e.totalError = 0, setTimeout(function() {
                                $(".rv-upload-progress li").remove(), e.totalQueued = 1
                            }, 300)
                        })
                    }
                }, {
                    key: "initProgress",
                    value: function(t, a) {
                        var i = this.uploadProgressTemplate.replace(/__fileName__/gi, t).replace(/__fileSize__/gi, e.formatFileSize(a)).replace(/__status__/gi, "warning").replace(/__message__/gi, "Uploading");
                        this.uploadProgressContainer.append(i), this.uploadProgressBox.removeClass("hide-the-pane"), this.uploadProgressBox.find(".panel-body").animate({
                            scrollTop: this.uploadProgressContainer.height()
                        }, 150)
                    }
                }, {
                    key: "changeProgressStatus",
                    value: function(e) {
                        var t = this.uploadProgressContainer.find("li:nth-child(" + e.index + ")"),
                            a = t.find(".label");
                        a.removeClass("label-success label-danger label-warning");
                        var i = n.a.jsonDecode(e.xhr.responseText || "", {});
                        if (this.totalError = this.totalError + (!0 === i.error || "error" === e.status ? 1 : 0), a.addClass(!0 === i.error || "error" === e.status ? "label-danger" : "label-success"), a.html(!0 === i.error || "error" === e.status ? "Error" : "Uploaded"), "error" === e.status)
                            if (422 === e.xhr.status) {
                                var r = "";
                                $.each(i, function(e, t) {
                                    r += '<span class="text-danger">' + t + "</span><br>"
                                }), t.find(".file-error").html(r)
                            } else 500 === e.xhr.status && t.find(".file-error").html('<span class="text-danger">' + e.xhr.statusText + "</span>");
                        else i.error ? t.find(".file-error").html('<span class="text-danger">' + i.message + "</span>") : (n.a.addToRecent(i.data.id), n.a.setSelectedFile(i.data.id))
                    }
                }]) && b(t.prototype, a), i && b(t, i), e
            }(),
            k = {
                api_key: "AIzaSyCV4fmfdgsValGNR3sc-0W3cbpEZ8uON33d"
            };

        function M(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var I = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.MediaService = new h, this.$body = $("body"), this.$modal = $("#modal_add_from_youtube");
                var t = this;
                this.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.original_msg), this.$modal.on("hidden.bs.modal", function() {
                    t.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.original_msg)
                }), this.$body.off("click", "#modal_add_from_youtube .rv-btn-add-youtube-url").on("click", "#modal_add_from_youtube .rv-btn-add-youtube-url", function(e) {
                    e.preventDefault(), t.checkYouTubeVideo($(e.currentTarget).closest("#modal_add_from_youtube").find(".rv-youtube-url"))
                })
            }
            var t, a, i;
            return t = e, i = [{
                key: "validateYouTubeLink",
                value: function(e) {
                    return !!e.match(/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/) && RegExp.$1
                }
            }, {
                key: "getYouTubeId",
                value: function(e) {
                    var t = e.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/);
                    return t && 11 === t[2].length ? t[2] : null
                }
            }, {
                key: "getYoutubePlaylistId",
                value: function(e) {
                    var t = e.match(/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?list=|\&list=)([^#\&\?]*).*/);
                    return t ? t[2] : null
                }
            }], (a = [{
                key: "setMessage",
                value: function(e) {
                    this.$modal.find(".modal-notice").html(e)
                }
            }, {
                key: "checkYouTubeVideo",
                value: function(t) {
                    var a = this;
                    if (e.validateYouTubeLink(t.val()) && k.api_key) {
                        var i = e.getYouTubeId(t.val()),
                            r = "https://www.googleapis.com/youtube/v3/videos?id=" + i,
                            s = a.$modal.find('.custom-checkbox input[type="checkbox"]').is(":checked");
                        s && (r = "https://www.googleapis.com/youtube/v3/playlistItems?playlistId=" + (i = e.getYoutubePlaylistId(t.val()))), $.ajax({
                            url: r + "&key=" + k.api_key + "&part=snippet",
                            type: "GET",
                            success: function(e) {
                                s ? a.$modal.modal("hide") : function(e, t) {
                                    $.ajax({
                                        url: RV_MEDIA_URL.add_external_service,
                                        type: "POST",
                                        dataType: "json",
                                        data: {
                                            type: "youtube",
                                            name: e.items[0].snippet.title,
                                            folder_id: n.a.getRequestParams().folder_id,
                                            url: t,
                                            options: {
                                                thumb: "https://img.youtube.com/vi/" + e.items[0].id + "/maxresdefault.jpg"
                                            }
                                        },
                                        success: function(e) {
                                            e.error ? o.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header) : (o.showMessage("success", e.message, RV_MEDIA_CONFIG.translations.message.success_header), a.MediaService.getMedia(!0))
                                        },
                                        error: function(e) {
                                            o.handleError(e)
                                        }
                                    }), a.$modal.modal("hide")
                                }(e, t.val())
                            },
                            error: function() {
                                a.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.error_msg)
                            }
                        })
                    } else k.api_key ? a.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.invalid_url_msg) : a.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.no_api_key_msg)
                }
            }]) && M(t.prototype, a), i && M(t, i), e
        }();
        var C = function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), new I
            },
            E = a(23);

        function R(e, t) {
            for (var a = 0; a < t.length; a++) {
                var i = t[a];
                i.enumerable = i.enumerable || !1, i.configurable = !0, "value" in i && (i.writable = !0), Object.defineProperty(e, i.key, i)
            }
        }
        var D = function() {
            function e() {
                ! function(e, t) {
                    if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
                }(this, e), this.MediaService = new h, this.UploadService = new w, this.FolderService = new y, new C, this.$body = $("body")
            }
            var t, a, r;
            return t = e, r = [{
                key: "setupSecurity",
                value: function() {
                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        }
                    })
                }
            }], (a = [{
                key: "init",
                value: function() {
                    n.a.resetPagination(), this.setupLayout(), this.handleMediaList(), this.changeViewType(), this.changeFilter(), this.search(), this.handleActions(), this.UploadService.init(), this.handleModals(), this.scrollGetMore()
                }
            }, {
                key: "setupLayout",
                value: function() {
                    var e = $('.js-rv-media-change-filter[data-type="filter"][data-value="' + n.a.getRequestParams().filter + '"]');
                    e.closest("li").addClass("active").closest(".dropdown").find(".js-rv-media-filter-current").html("(" + e.html() + ")");
                    var t = $('.js-rv-media-change-filter[data-type="view_in"][data-value="' + n.a.getRequestParams().view_in + '"]');
                    t.closest("li").addClass("active").closest(".dropdown").find(".js-rv-media-filter-current").html("(" + t.html() + ")"), n.a.isUseInModal() && $(".rv-media-footer").removeClass("hidden"), $('.js-rv-media-change-filter[data-type="sort_by"][data-value="' + n.a.getRequestParams().sort_by + '"]').closest("li").addClass("active");
                    var a = $("#media_details_collapse");
                    a.prop("checked", i.a.hide_details_pane || !1), setTimeout(function() {
                        $(".rv-media-details").removeClass("hidden")
                    }, 300), a.on("change", function(e) {
                        e.preventDefault(), i.a.hide_details_pane = $(e.currentTarget).is(":checked"), n.a.storeConfig()
                    }), $(document).off("click", "button[data-dismiss-modal]").on("click", "button[data-dismiss-modal]", function(e) {
                        var t = $(e.currentTarget).data("dismiss-modal");
                        $(t).modal("hide")
                    })
                }
            }, {
                key: "handleMediaList",
                value: function() {
                    var e = this,
                        t = !1,
                        a = !1,
                        i = !1;
                    $(document).on("keyup keydown", function(e) {
                        t = e.ctrlKey, a = e.metaKey, i = e.shiftKey
                    }), e.$body.off("click", ".js-media-list-title").on("click", ".js-media-list-title", function(r) {
                        r.preventDefault();
                        var o = $(r.currentTarget);
                        if (i) {
                            var s = _.first(n.a.getSelectedItems());
                            if (s) {
                                var d = s.index_key,
                                    c = o.index();
                                $(".rv-media-items li").each(function(e, t) {
                                    e > d && e <= c && $(t).find("input[type=checkbox]").prop("checked", !0)
                                })
                            }
                        } else t || a || o.closest(".rv-media-items").find("input[type=checkbox]").prop("checked", !1);
                        o.find("input[type=checkbox]").prop("checked", !0), l.handleDropdown(), e.MediaService.getFileDetails(o.data())
                    }).on("dblclick", ".js-media-list-title", function(t) {
                        t.preventDefault();
                        var a = $(t.currentTarget).data();
                        if (!0 === a.is_folder) n.a.resetPagination(), e.FolderService.changeFolder(a.id);
                        else if (n.a.isUseInModal()) {
                            if ("trash" !== n.a.getConfigs().request_params.view_in) {
                                var i = n.a.getSelectedFiles();
                                _.size(i) > 0 && E.EditorService.editorSelectFile(i)
                            }
                        } else l.handlePreview()
                    }).on("dblclick", ".js-up-one-level", function(e) {
                        e.preventDefault();
                        var t = $(".rv-media-breadcrumb .breadcrumb li").length;
                        $(".rv-media-breadcrumb .breadcrumb li:nth-child(" + (t - 1) + ") a").trigger("click")
                    }).on("contextmenu", ".js-context-menu", function(e) {
                        $(e.currentTarget).find("input[type=checkbox]").is(":checked") || $(e.currentTarget).trigger("click")
                    }).on("click contextmenu", ".rv-media-items", function(t) {
                        _.size(t.target.closest(".js-context-menu")) || ($('.rv-media-items input[type="checkbox"]').prop("checked", !1), $(".rv-dropdown-actions").addClass("disabled"), e.MediaService.getFileDetails({
                            icon: "far fa-image",
                            nothing_selected: ""
                        }))
                    })
                }
            }, {
                key: "changeViewType",
                value: function() {
                    var e = this;
                    e.$body.off("click", ".js-rv-media-change-view-type .btn").on("click", ".js-rv-media-change-view-type .btn", function(t) {
                        t.preventDefault();
                        var a = $(t.currentTarget);
                        a.hasClass("active") || (a.closest(".js-rv-media-change-view-type").find(".btn").removeClass("active"), a.addClass("active"), i.a.request_params.view_type = a.data("type"), "trash" === a.data("type") ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), n.a.storeConfig(), void 0 !== RV_MEDIA_CONFIG.pagination && void 0 !== RV_MEDIA_CONFIG.pagination.paged && (RV_MEDIA_CONFIG.pagination.paged = 1), e.MediaService.getMedia(!0, !1))
                    }), $('.js-rv-media-change-view-type .btn[data-type="' + n.a.getRequestParams().view_type + '"]').trigger("click"), this.bindIntegrateModalEvents()
                }
            }, {
                key: "changeFilter",
                value: function() {
                    var e = this;
                    e.$body.off("click", ".js-rv-media-change-filter").on("click", ".js-rv-media-change-filter", function(t) {
                        if (t.preventDefault(), !n.a.isOnAjaxLoading()) {
                            var a = $(t.currentTarget),
                                r = a.closest("ul"),
                                o = a.data();
                            i.a.request_params[o.type] = o.value, "view_in" === o.type && (i.a.request_params.folder_id = 0, "trash" === o.value ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1)), a.closest(".dropdown").find(".js-rv-media-filter-current").html("(" + a.html() + ")"), n.a.storeConfig(), h.refreshFilter(), n.a.resetPagination(), e.MediaService.getMedia(!0), r.find("> li").removeClass("active"), a.closest("li").addClass("active")
                        }
                    })
                }
            }, {
                key: "search",
                value: function() {
                    var e = this;
                    $('.input-search-wrapper input[type="text"]').val(n.a.getRequestParams().search || ""), e.$body.off("submit", ".input-search-wrapper").on("submit", ".input-search-wrapper", function(t) {
                        t.preventDefault(), i.a.request_params.search = $(t.currentTarget).find('input[type="text"]').val(), n.a.storeConfig(), n.a.resetPagination(), e.MediaService.getMedia(!0)
                    })
                }
            }, {
                key: "handleActions",
                value: function() {
                    var e = this;
                    e.$body.off("click", '.rv-media-actions .js-change-action[data-type="refresh"]').on("click", '.rv-media-actions .js-change-action[data-type="refresh"]', function(t) {
                        t.preventDefault(), n.a.resetPagination();
                        var a = void 0 !== window.rvMedia.$el ? window.rvMedia.$el.data("rv-media") : void 0;
                        void 0 !== a && a.length > 0 && void 0 !== a[0].selected_file_id ? e.MediaService.getMedia(!0, !0) : e.MediaService.getMedia(!0, !1)
                    }).off("click", ".rv-media-items li.no-items").on("click", ".rv-media-items li.no-items", function(e) {
                        e.preventDefault(), $(".rv-media-header .rv-media-top-header .rv-media-actions .js-dropzone-upload").trigger("click")
                    }).off("submit", ".form-add-folder").on("submit", ".form-add-folder", function(t) {
                        t.preventDefault();
                        var a = $(t.currentTarget).find("input[type=text]"),
                            i = a.val();
                        return e.FolderService.create(i), a.val(""), !1
                    }).off("click", ".js-change-folder").on("click", ".js-change-folder", function(t) {
                        t.preventDefault();
                        var a = $(t.currentTarget).data("folder");
                        n.a.resetPagination(), e.FolderService.changeFolder(a)
                    }).off("click", ".js-files-action").on("click", ".js-files-action", function(t) {
                        t.preventDefault(), l.handleGlobalAction($(t.currentTarget).data("action"), function() {
                            n.a.resetPagination(), e.MediaService.getMedia(!0)
                        })
                    })
                }
            }, {
                key: "handleModals",
                value: function() {
                    var e = this;
                    e.$body.on("show.bs.modal", "#modal_rename_items", function() {
                        l.renderRenameItems()
                    }), e.$body.off("submit", "#modal_rename_items .form-rename").on("submit", "#modal_rename_items .form-rename", function(t) {
                        t.preventDefault();
                        var a = [],
                            i = $(t.currentTarget);
                        $("#modal_rename_items .form-control").each(function(e, t) {
                            var i = $(t),
                                n = i.closest(".form-group").data();
                            n.name = i.val(), a.push(n)
                        }), l.processAction({
                            action: i.data("action"),
                            selected: a
                        }, function(t) {
                            t.error ? $("#modal_rename_items .form-group").each(function(e, a) {
                                var i = $(a);
                                _.includes(t.data, i.data("id")) ? i.addClass("has-error") : i.removeClass("has-error")
                            }) : (i.closest(".modal").modal("hide"), e.MediaService.getMedia(!0))
                        })
                    }), e.$body.off("submit", ".form-delete-items").on("submit", ".form-delete-items", function(t) {
                        t.preventDefault();
                        var a = [],
                            i = $(t.currentTarget);
                        _.each(n.a.getSelectedItems(), function(e) {
                            a.push({
                                id: e.id,
                                is_folder: e.is_folder
                            })
                        }), l.processAction({
                            action: i.data("action"),
                            selected: a
                        }, function(t) {
                            i.closest(".modal").modal("hide"), t.error || e.MediaService.getMedia(!0)
                        })
                    }), e.$body.off("submit", "#modal_empty_trash .rv-form").on("submit", "#modal_empty_trash .rv-form", function(t) {
                        t.preventDefault();
                        var a = $(t.currentTarget);
                        l.processAction({
                            action: a.data("action")
                        }, function() {
                            a.closest(".modal").modal("hide"), e.MediaService.getMedia(!0)
                        })
                    }), "trash" === i.a.request_params.view_in ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), this.bindIntegrateModalEvents()
                }
            }, {
                key: "checkFileTypeSelect",
                value: function(e) {
                    if (void 0 !== window.rvMedia.$el) {
                        var t = _.first(e),
                            a = window.rvMedia.$el.data("rv-media");
                        if (void 0 !== a && void 0 !== a[0] && void 0 !== a[0].file_type && "undefined" !== t && "undefined" !== t.type) {
                            if (!a[0].file_type.match(t.type)) return !1;
                            if (void 0 !== a[0].ext_allowed && $.isArray(a[0].ext_allowed) && -1 == $.inArray(t.mime_type, a[0].ext_allowed)) return !1
                        }
                    }
                    return !0
                }
            }, {
                key: "bindIntegrateModalEvents",
                value: function() {
                    var e = $("#rv_media_modal"),
                        t = this;
                    e.off("click", ".js-insert-to-editor").on("click", ".js-insert-to-editor", function(a) {
                        a.preventDefault();
                        var i = n.a.getSelectedFiles();
                        _.size(i) > 0 && (window.rvMedia.options.onSelectFiles(i, window.rvMedia.$el), t.checkFileTypeSelect(i) && e.find(".close").trigger("click"))
                    }), e.off("dblclick", ".js-media-list-title").on("dblclick", ".js-media-list-title", function(a) {
                        if (a.preventDefault(), "trash" !== n.a.getConfigs().request_params.view_in) {
                            var i = n.a.getSelectedFiles();
                            _.size(i) > 0 && (window.rvMedia.options.onSelectFiles(i, window.rvMedia.$el), t.checkFileTypeSelect(i) && e.find(".close").trigger("click"))
                        } else l.handlePreview()
                    })
                }
            }, {
                key: "scrollGetMore",
                value: function() {
                    var e = this;
                    $(".rv-media-main .rv-media-items").bind("DOMMouseScroll mousewheel", function(t) {
                        if (t.originalEvent.detail > 0 || t.originalEvent.wheelDelta < 0) {
                            if ($(t.currentTarget).closest(".media-modal").length > 0 ? $(t.currentTarget).scrollTop() + $(t.currentTarget).innerHeight() / 2 >= $(t.currentTarget)[0].scrollHeight - 450 : $(t.currentTarget).scrollTop() + $(t.currentTarget).innerHeight() >= $(t.currentTarget)[0].scrollHeight - 150) {
                                if (void 0 === RV_MEDIA_CONFIG.pagination || !RV_MEDIA_CONFIG.pagination.has_more) return;
                                e.MediaService.getMedia(!1, !1, !0)
                            }
                        }
                    })
                }
            }]) && R(t.prototype, a), r && R(t, r), e
        }();
        $(document).ready(function() {
            window.rvMedia = window.rvMedia || {}, D.setupSecurity(), (new D).init()
        })
    }
});