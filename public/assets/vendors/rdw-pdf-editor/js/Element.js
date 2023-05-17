class Element {
    /**
     *  Class constructor
     *
     *  @param {*} data
     */
    constructor(data) {
        this.template = data.template;
        this.workspaceId = data.workspaceId;
        this.id = data.id;
        this.image = data.image;
        this.restricted = data.restricted || false;
        this.color = data.color || "rgba(0, 0, 0, 0.5)";
        this.font = data.font || "Helvetica";
        this.posX = data.posX || 0;
        this.posY = data.posY || 0;
        this.width = data.width || 100;
        this.height = data.height || 100;
        this.size = data.size || 100;
        this.page = data.page || 1;
        this.HTML = null;
    }

    /**
     *  Create element
     *
     */
    createElement(closure = {}) {
        //  On click
        function _onClick(event) {
            if (event.preventDefault()) {
                event.preventDefault();
            }
            event.stopPropagation();
            //  Remove all selected class elements
            $(".element-interactable").removeClass("element-selected");
            //  Select element
            $(this).addClass("element-selected");
            //  Change color
            document.querySelector('input[type="color"]').value = "#" + object._rgbaToHex(object.HTML[0].style.backgroundColor);
            //  Change font
            document.getElementById("font").value = object.font;
            //  Store variable to global data
            window.selectedElementObject = object;
            //  If has closure
            if (closure.onClick != undefined) {
                closure.onClick();
            }
        }

        //  On double click
        function _onDblClick(event) {
            if (event.preventDefault()) {
                event.preventDefault();
            }

            //  Remove the element with swal confirm
            swal.fire({
                title: "Hapus Elemen",
                text: "Hapus template elemen ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#0067ac",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    //  Show button
                    if (object.template.HTML.hasClass("hidden")) {
                        object.template.HTML.removeClass("hidden");
                    }
                    //  Remove object from list
                    object.template.elements.pop();
                    //  Remove element
                    $(this).remove();
                    //  If has closure
                    if (closure.onDblClick != undefined) {
                        closure.onDblClick();
                    }
                }
            });
        }

        //  Interactable element
        function _interactable() {
            //  Draggable config
            function __draggableConfig() {
                return {
                    modifiers: [
                        interact.modifiers.restrictRect({
                            restriction: "parent",
                            endOnly: false,
                        }),
                    ],
                    autoScroll: true,
                    listeners: {
                        move: __draggableListener,
                    },
                    inertia: {
                        resistance: 30,
                        minSpeed: 200,
                        endSpeed: 100,
                    },
                };
            }

            //  Resizable config
            function __resizableConfig() {
                return {
                    edges: { left: true, right: true, bottom: true, top: true },
                    listeners: {
                        move: __resizableListener,
                    },
                    modifiers: [
                        interact.modifiers.restrictEdges({
                            outer: "parent",
                        }),
                        interact.modifiers.restrictSize({
                            min: { width: 50, height: 50 },
                        }),
                    ],
                    inertia: {
                        resistance: 30,
                        minSpeed: 200,
                        endSpeed: 100,
                    },
                };
            }

            //  Draggable listener
            function __draggableListener(event) {
                //  Set target
                var target = event.target;
                //  Parse X and Y
                var x =
                    (parseFloat(target.getAttribute("data-x")) || 0) + event.dx;
                var y =
                    (parseFloat(target.getAttribute("data-y")) || 0) + event.dy;
                //  Translate object
                target.style.transform = "translate(" + x + "px, " + y + "px)";
                //  Set element coordinate attribute
                target.setAttribute("data-x", x);
                target.setAttribute("data-y", y);
                //  Set this element attribute
                object.posX = x;
                object.posY = y;

                //  If has closure
                if (closure.onDrag != undefined) {
                    closure.onDrag();
                }
            }

            //  Resizable listener
            function __resizableListener(event) {
                //  Set target
                var target = event.target;
                //  Parse X, Y, and size
                var x = parseFloat(target.getAttribute("data-x")) || 0;
                var y = parseFloat(target.getAttribute("data-y")) || 0;
                var size = (event.rect.width + event.rect.height) / 2;
                //  Set height and width
                target.style.width = size + "px";
                target.style.height = size + "px";
                //  Resize element
                x += event.deltaRect.left;
                y += event.deltaRect.top;
                //  Translate object
                target.style.transform = "translate(" + x + "px," + y + "px)";
                //  Set element coordinate and size attribute
                target.setAttribute("data-x", x);
                target.setAttribute("data-y", y);
                target.setAttribute("size", size);
                //  Set this element attribute
                object.width = target.style.width;
                object.height = target.style.height;
                object.size = size;
                object.posX = x;
                object.posY = y;

                //  If has closure
                if (closure.onDrag != undefined) {
                    closure.onDrag();
                }
            }

            //  Apply interactable element
            interact("#" + object.id)
                .draggable(__draggableConfig())
                .resizable(__resizableConfig());
        }

        //  Set element
        var object = this;

        //  If element is restricted, cannot draggable
        if (this.restricted) {
            //  Create element
            var elementHTML = `
                <div id="${this.id}" data-x="${this.posX}" data-y="${this.posY}" page="${this.page}" size="${this.size}" 
                    class="element-restrict shadow" style="
                        width: ${this.width}px;
                        height: ${this.height}px;
                        transform: translate(${this.posX}px, ${this.posY}px);
                        background-image: url('${this.image}');
                        background-color: ${this.color};
                        background-size: contain;
                        background-repeat: no-repeat;
                        position: absolute;
                        border-radius: 8px;
                        border-color: red;
                        border-width: 4px;
                        border-style: dashed;
                        ">
                </div>
            `;
            //  Append element to workspace
            $("#" + this.workspaceId).append(elementHTML);
        } else {
            //  Create element
            var elementHTML = `
                <div id="${this.id}" data-x="${this.posX}" data-y="${this.posY}" page="${this.page}" size="${this.size}" 
                    class="element-interactable shadow" style="
                        width: ${this.width}px;
                        height: ${this.height}px;
                        transform: translate(${this.posX}px, ${this.posY}px);
                        background-image: url('${this.image}');
                        background-color: ${this.color};
                        background-size: contain;
                        background-repeat: no-repeat;
                        position: absolute;
                        border-radius: 8px;
                        ">
                </div>
            `;
            //  Append element to workspace
            $("#" + this.workspaceId).append(elementHTML);
            //  Get element
            this.HTML = $("#" + this.id);
            //  Handle element
            this.HTML.on("click", _onClick);
            this.HTML.on("dblclick", _onDblClick);
            _interactable();
        }

        //  Return this
        return this;
    }

    _rgbaToHex(rgba) {
        var a,
            isPercent,
            rgb = rgba
                .replace(/\s/g, "")
                .match(/^rgba?\((\d+),(\d+),(\d+),?([^,\s)]+)?/i),
            alpha = ((rgb && rgb[4]) || "").trim(),
            hex = rgb
                ? (rgb[1] | (1 << 8)).toString(16).slice(1) +
                  (rgb[2] | (1 << 8)).toString(16).slice(1) +
                  (rgb[3] | (1 << 8)).toString(16).slice(1)
                : rgba;

        if (alpha !== "") {
            a = alpha;
        } else {
            a = "01";
        }
        // multiply before convert to HEX
        a = ((a * 255) | (1 << 8)).toString(16).slice(1);

        return hex;
    }

    
}
