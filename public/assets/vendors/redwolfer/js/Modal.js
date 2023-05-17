class Modal {
    constructor () {
        this.TYPES = ['primary', 'secondary', 'dark', 'info', 'success', 'warning', 'danger'];
        this.SIZES = ['sm', 'md', 'lg', 'xl'];
    }

    setStyle(type, size, title, submitButtonText) {
        const $modalHeader = $("body .modal-header");
        const $submitBtn = $("body .btn-submit-modal");
        const $modalDialog = $("body .modal-dialog");
        const $modalTitle = $("body .modal-title");

        this.TYPES.forEach(e => $modalHeader.removeClass("bg-gradient-" + e));
        this.TYPES.forEach(e => $submitBtn.removeClass("btn-" + e));

        this.SIZES.forEach(e => $modalDialog.removeClass("modal-" + e));
        $modalHeader.addClass("bg-gradient-" + type);
        $submitBtn.addClass("btn-" + type);
        $modalDialog.addClass("modal-" + size);

        $modalTitle.text(title);
        if (submitButtonText !== undefined) {
            $submitBtn.text(submitButtonText);
            $submitBtn.removeClass("hidden");
        } else {
            $submitBtn.addClass("hidden");
        }

        return this;
    }

    setContent(element) {
        $.get(element.attr("href"), null,
            function (data, textStatus, jqXHR) {
                $("body .modal-body").html(data);
            }
        );
    }

    fireSwal(data, form) {

        var modal = this;

        function fireSuccessSwal(text) {
            Swal.fire({
                title: "Berhasil",
                text: text,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        }

        function fireSwalLoading(dataLoading) {
            Swal.fire({
                showCancelButton: false,
                showConfirmButton: false,
                allowOutsideClick: false,
                title: dataLoading.title,
                text: dataLoading.text,
                onOpen: () => {
                    Swal.showLoading();
                }
            });
        }

        function checkXHRErrors(data) {
            var jsonXHR = data.responseJSON;
            if ($.isEmptyObject(jsonXHR) == false) {
                $.each(jsonXHR.errors, function (key, value) {
                    $("#" + key)
                        .closest(".with-validation")
                        .addClass("has-error")
                        .append(`<span class="help-block text-danger"><small>${value}</small></span>`);
                    $("#" + key).addClass("is-invalid");
                });
            }

            Swal.fire({
                title: "Terjadi kesalahan sistem",
                text: jsonXHR.message,
                icon: 'error',
                confirmButtonColor: '#0067ac',
                cancelButtonColor: '#d33',
            });
        }

        function checkGeneralError() {
            Swal.fire({
                title: "Terjadi kesalahan sistem",
                text: "Harap hubungi administrator",
                icon: 'error',
                confirmButtonColor: '#0067ac',
                cancelButtonColor: '#d33',
            });
        }

        function removeErrorValidation() {
            $(".modal-body form")
                .children()
                .removeClass("has-error")
                .find(".help-block")
                .remove();

            $(".modal-body form")
                .find("input, select, textarea")
                .removeClass("is-invalid");
        }

        $("body").on("click", ".btn-submit-modal", function (e) {
            e.preventDefault();

            //  Show swal
            Swal.fire({
                title: data.title,
                text: data.text,
                icon: 'warning',
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonColor: '#0067ac',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    fireSwalLoading(data.loading);
                    removeErrorValidation();

                    //  Set request data
                    var requestData = $(".modal-body form").serializeArray();
                    requestData.push({ name: '_method', value: 'POST' });

                    $.ajax({
                        method: "POST",
                        // cache: false,
                        // contentType: false,
                        // processData: false,
                        url: $(".modal-body form").attr("action"),
                        data: requestData,
                        success: function (response) {
                            if (response.success) {
                                fireSuccessSwal(response.message);
                                if (data.after !== undefined) {
                                    data.after();
                                }
                                modal.hide();
                            } else {
                                checkGeneralError();
                            }
                        },
                        error: function (xhr) {
                            checkXHRErrors(xhr);
                        }
                    });
                }
            });
        });
    }

    show() {
        $("body .modal").modal("show");
        return this;
    }

    hide() {
        $("body .modal").modal("hide");
        return this;
    }
}
