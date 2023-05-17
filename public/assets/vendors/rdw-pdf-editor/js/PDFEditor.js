class PDFEditor {
    constructor({ source, id, templates = [] }) {
        this.source = source;
        this.id = id;
        this.templates = templates;

        this.currentPage = 1;
        this.startPage = 1;
        this.endPage = 1;

        this.currentScale = 1;
        this.scale = 1;

        this.currentPDF = null;
        this.pageRendering = false;
        this.pageNumPending = null;
        this.canvas = document.getElementById(id);
        this.ctx = this.canvas.getContext("2d");

        this.width = null;
        this.height = null;
    }

    /**
     *  Render the page
     *
     *  @param {this} pdf
     *  @param {int} page
     */
    _renderPage(pdf, page) {
        //  Set page rendering to true
        pdf.pageRendering = true;
        //  Render page
        pdf.currentPDF.getPage(page).then(function (page) {
            //  Set viewport height and width
            var viewport = page.getViewport({ scale: pdf.scale });
            pdf.canvas.height = viewport.height;
            pdf.canvas.width = viewport.width;
            //  Set canvas top layer width and height to be centered automaticly
            $("#canvas-top-layer").css("width", pdf.canvas.width);
            $("#canvas-top-layer").css("height", pdf.canvas.height);
            //  Set canvas x axis positioning
            var canvasContainerWidth = $("#canvas-container").css("width").replace("px", "");
            var canvasLayerWidth = $("#canvas-bottom-layer").css("width").replace("px", "");
            var canvasPaddingResult = ((canvasContainerWidth - canvasLayerWidth) / 2) + "px";
            $("#canvas-bottom-layer").css("left", canvasPaddingResult);
            $("#canvas-top-layer").css("left", canvasPaddingResult);
            $("#canvas-container").css("height", pdf.canvas.height + 48);
            $("section.content").css("height", "auto");
            $("section.content").css("margin-bottom", "12px");
            // Render PDF page into canvas context
            var renderContext = {
                canvasContext: pdf.ctx,
                viewport: viewport,
            };
            var renderTask = page.render(renderContext);
            // Wait for rendering to finish
            renderTask.promise.then(function () {
                pdf.pageRendering = false;
                if (pdf.pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pdf, pdf.pageNumPending);
                    pdf.pageNumPending = null;
                }
            });
            //  Get active elements
            var activeElements = document.getElementsByClassName("element-interactable");
            //  Get restricted elements
            var restrictedElements = document.getElementsByClassName("element-restrict");
            //  Rescale elements
            pdf._rescaleElements(pdf, activeElements);
            pdf._rescaleElements(pdf, restrictedElements);
        });

        //  Set current page
        $("#page-number").val();
        $("#page-number").val(pdf.currentPage + ' / ' + pdf.currentPDF.numPages);

        //  Set scale
        $("#scale").val();
        $("#scale").val(parseInt(pdf.scale * 100) + " %");
    }

    /**
     *  Queue render page
     *
     */
    _queueRenderPage() {
        if (this.pageRendering) {
            this.pageNumPending = this.currentPage;
        } else {
            var pdf = this;
            this._renderPage(pdf, pdf.currentPage);
        }
    }

    /**
     *  On previous page
     *
     */
    _onPreviousPage() {
        if (this.currentPage <= 1) {
            return;
        }
        this.currentScale = this.scale;
        this.currentPage--;
        this._queueRenderPage();
    }

    /**
     *  On next page
     *
     */
    _onNextPage() {
        if (this.currentPage >= this.currentPDF.numPages) {
            return;
        }
        this.currentScale = this.scale;
        this.currentPage++;
        this._queueRenderPage();
    }

    /**
     *  On zoom in
     *
     */
    _onZoomIn() {

        if (this._isOverflow()) {
            return;
        }

        this.currentScale = this.scale;
        this.scale += 0.1;
        this._queueRenderPage();
    }

    /**
     *  On zoom out
     *
     */
    _onZoomOut() {
        this.currentScale = this.scale;
        this.scale -= 0.1;
        this._queueRenderPage();
    }

    /**
     *  On window resize
     *
     */
    _onWindowResize() {
        this._queueRenderPage();
    }

    /**
     *  Is page overflow
     *
     */
    _isOverflow() {
        var canvasContainerWidth = parseFloat($("#canvas-container").css("width").replace("px", ""));
        var canvasWidth = this.canvas.width;
        return canvasContainerWidth < (canvasWidth + 96);
    }

    /**
     *  Rescale elements
     *
     *  @param {this} pdf
     */
    _rescaleElements(pdf, collection) {
        if (collection.length != 0) {
            for (let i = 0; i < collection.length; i++) {

                var element = collection[i];

                var elementWidth = parseFloat(element.style.width.replace("px", ""));
                var elementHeight = parseFloat(element.style.height.replace("px", ""));
                var elementSize = (elementWidth + elementHeight) / 2;
                var elementPosX = element.getAttribute("data-x") || 0;
                var elementPosY = element.getAttribute("data-y") || 0;

                var newElementSize = ((elementSize / pdf.currentScale) * pdf.scale);
                var newElementPosX = ((elementPosX / pdf.currentScale) * pdf.scale);
                var newElementPosY = ((elementPosY / pdf.currentScale) * pdf.scale);

                //  Set new scale
                element.style.width = newElementSize + "px";
                element.style.height = newElementSize + "px";

                //  Set new position
                element.setAttribute("data-x", newElementPosX);
                element.setAttribute("data-y", newElementPosY);
                element.setAttribute("size", newElementSize);
                element.style.transform = `translate(${element.getAttribute("data-x")}px, ${element.getAttribute("data-Y")}px)`;

                //  Set new data
                for (let i in pdf.templates) {
                    for (let j in pdf.templates[i].elements) {
                        var temp = pdf.templates[i].elements[j];
                        if (temp.id == element.id) {
                            temp.width = newElementSize;
                            temp.height = newElementSize;
                            temp.size = newElementSize;
                            temp.posX = newElementPosX;
                            temp.posY = newElementPosY;
                        }
                    }
                }

                //  Hide ELement
                if (element.getAttribute("page") != pdf.currentPage) {
                    if (!element.classList.contains("hidden")) {
                        element.classList.add("hidden");
                    }
                } else {
                    if (element.classList.contains("hidden")) {
                        element.classList.remove("hidden");
                    }
                }
            }
        }
    }

    /**
     *  Render PDF
     *
     *  @returns
     */
    renderPDF() {
        var pdfObject = this;

        pdfjsLib.getDocument(pdfObject.source).promise.then((pdf) => {
            pdfObject.currentPDF = pdf;
            $("#end-page").empty();
            $("#end-page").append(pdfObject.currentPDF.numPages);
            pdfObject._renderPage(pdfObject, 1);
        });

        return this;
    }
}
