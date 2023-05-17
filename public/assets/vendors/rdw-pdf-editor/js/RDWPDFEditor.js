class RDWPDFEditor {
    constructor(options) {
        this.buttonWorkspace = options.buttonWorkspace;
        this.canvasWorkspace = options.canvasWorkspace;
        this.templates = options.templates;

        this.pdfEditor = new PDFEditor({
            source: options.source,
            id: options.canvasId,
        });
    }

    /**
     *  Render the PDF
     * 
     */
    renderPDF() {

        //  Render pdf
        this.pdfEditor.renderPDF();

        //  Previous page button
        $("#btn-prev").on("click", (event) => {
            this.pdfEditor._onPreviousPage();
        });

        //  Next page button
        $("#btn-next").on("click", (event) => {
            this.pdfEditor._onNextPage();
        });

        //  Previous page button
        $("#btn-zoom-in").on("click", (event) => {
            this.pdfEditor._onZoomIn();
        });

        //  Next page button
        $("#btn-zoom-out").on("click", (event) => {
            this.pdfEditor._onZoomOut();
        });

        //  Window resize
        $(window).on("resize", (event) => {
            this.pdfEditor._queueRenderPage();
        });

        //  Append templates to pdf editor
        this.pdfEditor.templates = this.templates;

        var object = this;

        $("#color").on("change", function(event) {
            var elementObject = window.selectedElementObject;
            $("#" + elementObject.id).css("background-color", object._hexToRgba($(this).val()));
            elementObject.color = object._hexToRgba($(this).val());
        });

        $("#font").on("change", function(event) {
            var elementObject = window.selectedElementObject;
            elementObject.font = $(this).val();
        });
    }

    _hexToRgba(hex) {
        var c;
        if (/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)) {
            c = hex.substring(1).split("");
            if (c.length == 3) {
                c = [c[0], c[0], c[1], c[1], c[2], c[2]];
            }
            c = "0x" + c.join("");
            return (
                "rgba(" +
                [(c >> 16) & 255, (c >> 8) & 255, c & 255].join(",") +
                ",0.5)"
            );
        }
        throw new Error("Bad Hex");
    }
}
