class SweetAlert {

    /**
     *  Fire swal
     *
     *  @param {*} data
     */
    static fire(data) {
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
                //  Fire swal loading
                Swal.fire({
                    showCancelButton: false,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    title: data.loading.title,
                    text: data.loading.text,
                    onOpen: () => {
                        Swal.showLoading();
                    }
                });

                //  Remove help block error validation
                $("form")
                    .children()
                    .removeClass("has-error")
                    .find(".help-block")
                    .remove();

                //  Remove is invalid
                $("form")
                    .find("input, select, textarea")
                    .removeClass("is-invalid");

                //  Create basic POST request data
                let requestData = {};
                requestData["_token"] = $(`meta[name="csrf-token"]`).attr("content");
                requestData["_method"] = "POST";

                //  Append forms to request data
                if (data.form !== undefined) {
                    Object.keys(data.form).forEach((key) => {
                        requestData[key] = data.form[key];
                    });
                }

                //  Convert to form data
                if (data.useFormData) {
                    let formData = new FormData();
                    for (let key in requestData) {
                        formData.append(key, requestData[key]);
                    }
                    requestData = formData;
                }

                //  Create basic AJAX data
                let ajaxData = {
                    method: "POST",
                    url: data.url,
                    data: requestData,
                    success: function (response) {
                        if (response.success) {

                            //  Fire success swal
                            Swal.fire({
                                title: "Berhasil",
                                text: response.message,
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false,
                            });

                            //  Whether after() callback is exists
                            data.after !== undefined ? data.after() : undefined;

                        } else {

                            //  Fire error swal
                            Swal.fire({
                                title: "Terjadi kesalahan sistem",
                                text: "Harap hubungi administrator",
                                icon: 'error',
                                confirmButtonColor: '#0067ac'
                            });
                        }
                    },
                    error: function (xhr) {

                        //  Create error text forms
                        var jsonXHR = xhr.responseJSON;
                        if ($.isEmptyObject(jsonXHR) == false) {
                            $.each(jsonXHR.errors, function (key, value) {
                                $("#" + key)
                                    .closest(".with-validation")
                                    .addClass("has-error")
                                    .append(`<span class="help-block text-danger"><small>${value}</small></span>`);
                                $("#" + key).addClass("is-invalid");
                            });
                        }

                        //  Fire error swal
                        Swal.fire({
                            title: "Terjadi kesalahan sistem",
                            text: jsonXHR.message,
                            icon: 'error',
                            confirmButtonColor: '#0067ac'
                        });
                    }
                };

                //  Add additional parameter for form data object
                if (data.useFormData) {
                    let additionalAjaxData = {
                        cache: false,
                        contentType: false,
                        processData: false,
                    };
                    Object.assign(ajaxData, additionalAjaxData);
                }

                //  Execute AJAX
                $.ajax(ajaxData);
            }
        });
    }
}
