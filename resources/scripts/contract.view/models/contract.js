var ContractApp = Backbone.Model.extend({
    defaults: {
        page_no: 1,
        total_pages: 0,
        view: "pdf",
        search_query: "",
        contract_id: 0,
        selected_annotation_id: 0,
        pdfscale: 1,
        showMeta: true,
        canrender: true,
        annotator: [],
        preClick: false,
        pdfLoaded: false
    },
    initialize: function (options) {
        var self = this;
        this.annotationCategories = options.categories_codelist;
        this.annotationChecklist = new AnnotationChecklistCollection();
        _.each(options.categories_checkList, function (category, key) {
            self.annotationChecklist.add({key: key, name: category});
        });
    },
    setAnnotatorInstance: function (annotator) {
        return this.set({"annotator": annotator});
    },
    getAnnotatorInstance: function (annotator) {
        return this.get("annotator");
    },
    loadMetadata: function () {
        var self = this;
        this.metadata.url = this.getMetadataUrl();
        this.metadata.fetch();
    },
    getShowMeta: function () {
        return this.get("showMeta");
    },
    getContractId: function () {
        return this.get("contract_id");
    },
    getMetadataSummaryLink: function () {
        return app_url + "/contract/" + this.getContractId();
    },
    getMetadataUrl: function () {
        return this.get('esapi') + "contract/" + this.getContractId() + "/metadata";
    },
    getAllPageUrl: function () {
        return this.get("allpage_url");
    },
    getAllAnnotationsUrl: function () {
        return this.get("annotation_url");
    },
    getSearchUrl: function () {
        return this.get("search_url");
    },
    setPrevClick: function (click) {
        this.set({"preClick": click});
    },
    setPdfLoaded: function (bool) {
        this.set({"pdfLoaded": bool});
    },
    isPdfLoaded: function () {
        return this.get("pdfLoaded");
    },
    isPrevClick: function () {
        return this.get("preClick");
    },
    getPdfUrl: function () {
        if (typeof pagesCollection !== "undefined" && pagesCollection.models.length) {
            var page_no = parseInt(this.getCurrentPage());
            var pageModel = pagesCollection.where({page_no: page_no});
            if (pageModel && pageModel[0] && pageModel[0].attributes) {
                return pageModel[0].get("pdf_url");
            }
        } else {
            if (this.get("pdf_url")) {
                return this.get("pdf_url");
            }
        }
        return "";
    },
    getFullPdfUrl: function () {
        return "";
    },
    getLoadAnnotationsUrl: function () {
        return this.get("annotation_url");
    },
    getAnnotationCategories: function () {
        return this.annotationCategories;
    },
    getCategoryChecklist: function () {
        return this.annotationChecklist;
    },
    getAnnotationsListAnchor: function () {
        return app_url + "/contract/" + this.getContractId() + "#annotations";
    },
    renderStart: function () {
        this.set({"canrender": true});
    },
    renderComplete: function () {
        this.set({"canrender": false});
    },
    canRender: function () {
        return this.get("canrender");
    },
    setCurrentPage: function (page_no) {
        page_no = parseInt(page_no);
        this.set({page_no: page_no});
    },
    getCurrentPage: function () {
        return this.get("page_no");
    },
    getTotalPages: function () {
        return this.get("total_pages");
    },
    setSelectedAnnotation: function (annotation_id) {
        this.set("selected_annotation_id", annotation_id);
    },
    resetSelectedAnnotation: function (annotation_id) {
        this.set("selected_annotation_id", 0);
    },
    getSelectedAnnotation: function () {
        return this.get("selected_annotation_id");
    },
    setView: function (view) {
        if (view.trim() == "pdf" || view.trim() == "text" || view.trim() == "search") {
            this.set({view: view});
        }
    },
    getView: function () {
        return this.get("view");
    },
    getSearchQuery: function () {
        return this.get("search_query");
    },
    setSearchQuery: function (query) {
        this.set({search_query: query.trim()});
    },
    getPdfScale: function () {
        return this.get("pdfscale");
    },
    setPdfScale: function (scale) {
        return this.set({"pdfscale": scale});
    },
    triggerScrollToTextPage: function () {
        if (this.get("view") === "text" || this.get("view") === "search") {
            this.trigger('scroll-to-text-page');
        }
    },
    triggerGoToPdfPage: function () {
        if (this.get("view") === "pdf") {
            this.trigger('scroll-to-pdf-page');
        }
    },
    triggerUpdateTextPaginationPage: function (page_no) {
        if (this.get("view") === "text" || this.get("view") === "search") {
            this.trigger('update-text-pagination-page', page_no);
        }
    },
    triggerUpdatePdfPaginationPage: function (page_no) {
        if (this.get("view") === "pdf") {
            this.trigger("update-pdf-pagination-page", page_no);
        }
    },
    getBoxPosition: function (geo) {
        var canvas = $('.pdf-annotator').find('canvas').first();
        geo.width = geo.width * canvas.width();
        geo.height = geo.height * canvas.height();
        geo.x = geo.x * canvas.width();
        geo.y = geo.y * canvas.height();
        return geo;
    },
    showPdfAnnotationPopup: function (id) {
        if (this.isPdfLoaded() == false) {
            return true;
        }
        var wrapperEl = $('.pdf-annotator');
        wrapperEl.find('.annotator-viewer').addClass('annotator-hide');
        debug('show pdf annotation');
        var annotators = this.getAnnotatorInstance().content.data('annotator').dumpAnnotations();
        var self = this;
        annotators.map(function (annotation, i) {
            if (annotation.id == id) {
                var geo = self.getBoxPosition(annotation.shapes[0].geometry);
                var position = {top: (geo.y + geo.height / 2), left: (geo.x + geo.width / 2)};
                setTimeout(function () {
                    wrapperEl.animate({
                        scrollTop: position.top - 200
                    }, 'fast')
                }, 300);
                wrapperEl.annotator().annotator('showViewer', [annotation], position);
            }
        });
    },
    showTextAnnotationPopup: function (id) {
        var wrapperEl = $('.text-annotator');
        debug('show Text annotation');
        wrapperEl.find('.annotator-viewer').addClass('annotator-hide');
        wrapperEl.find('.annotator-hl').each(function (i, a) {
            var a = $(a);
            var annotation = a.data('annotation');
            if (annotation.id == id) {
                var position = a.position();
                setTimeout(function () {
                    wrapperEl.animate({
                        scrollTop: position.top - 200
                    }, 'fast')
                }, 300);
                position.top = position.top + 15;
                position.left = position.left + a.width() / 2;
                wrapperEl.annotator().annotator('showViewer', [annotation], position);
            }
        })
    },
    isViewVisible: function (viewName) {
        switch (viewName) {
            case "TextPaginationView":
            case "TextViewer":
            case "TextSearchForm":
                if ("text" === this.getView() || "search" === this.getView()) {
                    return true;
                } else {
                    return false;
                }
                break;
            case "TextSearchResultsList":
                if ("search" === this.getView()) {
                    return true;
                } else {
                    return false;
                }
                break;
            case "PdfPaginationView":
            case "PdfViewer":
            case "PdfZoom":
                if ("pdf" === this.getView()) {
                    return true;
                } else {
                    return false;
                }
                break;
            case "AnnotationsViewer":
                if ("search" === this.getView()) {
                    return false;
                } else {
                    return true;
                }
                break;
            case "RightColumnView":
                if (this.getShowMeta()) {
                    return true;
                } else {
                    return false;
                }
            default:
                return false;
        }
    }
});