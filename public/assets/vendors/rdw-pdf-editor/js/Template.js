class Template {
    /**
     *  Class constructor
     *
     *  @param {string} id
     *  @param {string} name
     *  @param {array} elements
     */
    constructor(id, name, pdf, max = 1, elements = []) {
        this.id = "btn-" + id + "-template";
        this.pdf = pdf;
        this.name = name;
        this.HTML = null;
        this.max = max;
        this.elements = [];
    }

    /**
     *  Create button element
     *
     *  @param {string} targetId
     *  @param {*} styles
     *  @returns
     */
    createElement(targetId, styles) {
        //  Parse object variables
        var type = styles.type || "primary";
        var icon = styles.icon || "square";
        var text = styles.text || "Element Button";
        //  Create element
        var element = `
            <li class="nav-item">
                <div class="nav-link">
                    <button role="button" draggable="true" style="cursor: move;" id="${this.id}" class="btn btn-block rounded-pill btn-${type}">
                        <i class="fas fa-${icon}"></i>
                        <span class="font-weight-bold">${text}</span>
                    </button>
                </div>
            </li>
        `;
        //  Append element to target
        $("#" + targetId).append(element);
        //  Set HTML element
        this.HTML = $("#" + this.id);
        //  Return this
        return this;
    }

    /**
     *  Enable draggable to workspace
     *
     *  @param {string} targetId
     *  @param {*} elementData
     */
    createableElementObject(targetId, elementData = {}) {
        //  On element drag start
        function _onDragStart(event) {
            this.style.opacity = 0.5;
            event.originalEvent.dataTransfer.setData(
                "text/plain",
                event.target.id
            );
        }

        //  On element drag end
        function _onDragEnd(event) {
            this.style.opacity = 1.0;
        }

        //  On element drag over
        function _onDragOver(event) {
            if (event.preventDefault()) {
                event.preventDefault();
            }
        }

        //  On element drag over
        function _onDragEnter(event) {
            if (event.preventDefault()) {
                event.preventDefault();
            }
        }

        //  On element drag leave
        function _onDragLeave(event) {
            if (event.preventDefault()) {
                event.preventDefault();
            }
        }

        //  On element drop
        function _onDrop(event) {
            event.stopPropagation();
            //  Get current dropped template id
            var templateId =
                event.originalEvent.dataTransfer.getData("text/plain");
            //  If dropped template is match with target event
            if (templateId == template.id) {
                //  Get X and Y position relative to canvas
                var x = event.offsetX;
                var y = event.offsetY;
                //  Create element object
                var elementObject = new Element({
                    template: template,
                    id:
                        "element-" +
                        template.name +
                        "-template-" +
                        (template.elements.length + 1),
                    workspaceId: targetId,
                    image: elementData.image,
                    color: elementData.isQR ? "rgba(0, 103, 172, 0.5)" : null,
                    posX: x,
                    posY: y,
                    width: elementData.width,
                    height: elementData.height,
                    size: elementData.size,
                    page: template.pdf.currentPage,
                });
                //  Create element HTML
                elementObject.createElement({
                    onClick: () => {
                        if (!elementData.noOptions) {
                            if ($("#form-options").hasClass("hidden")) {
                                $("#form-options").removeClass("hidden");
                            }
                        } else {
                            if (!$("#form-options").hasClass("hidden")) {
                                $("#form-options").addClass("hidden");
                            }
                        }
                    },
                    onDblClick: () => {
                        if (!elementData.noOptions) {
                            if (!$("#form-options").hasClass("hidden")) {
                                $("#form-options").addClass("hidden");
                            }
                        }
                        //  Check if all templates created
                        if (template._checkAllCreated(template.pdf.templates)) {
                            if ($("#form-submit").hasClass("hidden")) {
                                $("#form-submit").removeClass("hidden");
                            }
                        } else {
                            if (!$("#form-submit").hasClass("hidden")) {
                                $("#form-submit").addClass("hidden");
                            }
                        }
                    },
                });
                //  Push elements
                template.elements.push(elementObject);
                //  Hide button if it's on limit
                if (template.elements.length >= template.max) {
                    if (!$("#" + template.id).hasClass("hidden")) {
                        $("#" + template.id).addClass("hidden");
                    }
                }
                //  Check if all templates created
                if (template._checkAllCreated(template.pdf.templates)) {
                    if ($("#form-submit").hasClass("hidden")) {
                        $("#form-submit").removeClass("hidden");
                    }
                } else {
                    if (!$("#form-submit").hasClass("hidden")) {
                        $("#form-submit").addClass("hidden");
                    }
                }
            }
        }

        //  Set object
        var template = this;
        //  Get button element
        var element = $("#" + this.id);
        //  Get target element
        var target = $("#" + targetId);
        //  Handle button events
        element.on("dragstart", _onDragStart);
        element.on("dragend", _onDragEnd);
        //  Handle target events
        target.on("dragover", _onDragOver);
        target.on("dragenter", _onDragEnter);
        target.on("dragleave", _onDragLeave);
        target.on("drop", _onDrop);
        //  Return this
        return this;
    }

    /**
     *  Check if all element is created
     *
     *  @param {*} templates
     *  @returns
     */
    _checkAllCreated(templates) {
        var check = true;

        for (let i in templates) {
            if (templates[i].elements.length != 0) {
                check = true;
            } else {
                check = false;
                break;
            }
        }

        return check;
    }
}
