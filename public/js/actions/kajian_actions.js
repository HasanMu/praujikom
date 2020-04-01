var base_url = window.location.origin;
let $dataPOST = false;
let d_image = null;

class KajianAction {
    /* Get Image */
    getImg(post) {
        if (post.image) {
            return `
                    <img class="img-fluid banner-post" src="/assets/images/posts/${post.image}" alt="" style="border-radius: 10px;" data-action="zoom">
                `;
        } else {
            return "";
        }
    }
    /* End Get Image */

    /* Get Location */
    getLoc(post) {
        if (post.city_id || post.district_id) {
            return post.city_id && post.district_id
                ? `<ul class="tags city-tags">
                            <li><a href="#">${post.city.name}</a></li> |
                            <li><a href="#">${post.district.name}</a></li>
                        </ul>`
                : "" + post.city_id
                ? `<ul class="tags city-tags">
                            <li><a href="#">${post.city.name}</a></li>
                        </ul>`
                : "" + post.district_id
                ? `<ul class="tags city-tags">
                        <li><a href="#">${post.district.name} </a></li>
                        </ul>`
                : "";
        } else {
            return '<p class="tags"></p>';
        }
    }
    /* End Get Location */

    /* Dropdown Post */
    dropdownPoster(post) {
        return `
            <div class="nav-post-right">
                <a href="javascript:void(0)" class="" id="dropdownMenuLink" data-toggle="dropdown">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                </a>

                <div class="dropdown-menu setting-post" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item post-edit-${post.id}" href="javascript:void(0)" data-id="${post.id}">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Ubah
                    </a>
                    <a class="dropdown-item post-delete" href="javascript:void(0)" data-id="${post.id}">
                        <i class="fa fa-trash" aria-hidden="true"></i>Hapus
                    </a>
                </div>
            </div>
            `;
    }
    /* End Dropdown Post */

    /* Get set Modal */
    setModalEdit(modalId) {
        $(modalId).iziModal("setTitle", "Ubah Kajian");
        $(modalId).iziModal("setSubtitle", "Ubah Kajian ");
        $(modalId).iziModal("setIcon", "fa fa-trash");
        $(modalId).iziModal("resetContent", true);
    }
    /* End Get set Modal */

    /**
     * ====================
     * CONTROLLER
     * ===================
     */

    /* Get and Set Data Post*/
    dataPost(data) {
        return {
            get: $dataPOST,
            set: () => {
                if ($dataPOST != null) {
                    $dataPOST = null;
                    return ($dataPOST = data);
                } else {
                    return ($dataPOST = data);
                }
            }
        };
    }
    /* End Get and Set Data Post*/

    /* IsSelected ModalEdit */
    isSelected(url, idSelect, data_id, modal) {
        $.ajax({
            url: base_url + "/api/v1/" + url,
            method: "GET",
            success: res => {
                $("#form-edit #" + idSelect).html("");
                $("#form-edit #" + idSelect).html(
                    `<option value="">-- Pilih salah satu -- </option>`
                );

                $.each(res.data, (k, v) => {
                    $("#form-edit #" + idSelect).append(
                        `
                                <option value="${v.id}" ${
                            v.id === data_id ? "selected" : ""
                        }>${v.name}</option>
                            `
                    );
                });

                modal.stopLoading();
            },
            error: err => {
                console.log(err);
            }
        });
    }
    /* End IsSelected ModalEdit */

    /* replace Data ModalEdit */
    replaceDataInModal(post, modal) {
        const modalId = "#" + modal.id;
        const dataForm = $(modalId + " #form-edit").get();

        /* SELECT 2 ACTIVE */
        $("#form-edit #" + dataForm[0][1].id).select2();
        $("#form-edit #" + dataForm[0][2].id).select2();
        post.image ? $("#form-edit #prev-image").css("display", "block") : "";
        post.image
            ? $("#form-edit .delete-img").css("display", "block")
            : $("#form-edit .delete-img").css("display", "none");

        dataForm[0][0].value = post.description;
        this.isSelected("cities", dataForm[0][1].id, post.city_id, modal);
        this.isSelected(
            post.city_id + "/districts",
            dataForm[0][2].id,
            post.district_id,
            modal
        );
        post.image
            ? $("#form-edit #prev-image img").attr(
                  "src",
                  "/assets/images/posts/" + post.image
              )
            : "";
    }
    /* End replace Data ModalEdit */

    confModalEdit() {
        /* Instantiating iziModal */
        const $this = this;

        $("#modal-edit").iziModal({
            headerColor: "rgba(138, 144, 255, 0.9)",
            top: 10,
            overlayClose: false,
            overlayColor: "rgba(0, 0, 0, 0.6)",
            afterRender: function() {},
            onOpening: function(modal) {
                modal.startLoading();
                $this.replaceDataInModal($this.dataPost().get, modal);
                modal.stopLoading();
            },
            onOpened: function(modal) {
                $("#modal-edit").on("change", "#cities", function() {
                    let _id = $(this).val();

                    if (!_id) {
                        modal.startLoading();
                        $this.isSelected("/cities", "cities", 0, modal);
                    }

                    modal.startLoading();
                    $this.isSelected(
                        "" + _id + "/districts",
                        "districts",
                        0,
                        modal
                    );
                });

                $("#modal-edit").on("change", "#image", function() {
                    $("#modal-edit .delete-img").css("display", "block");
                    $("#modal-edit #prev-image img").css("display", "block");
                    d_image = false;
                    readURL("-edit", this);
                });

                $("#modal-edit .delete-img").on("click", () => {
                    $("#modal-edit .delete-img").css("display", "none");
                    $("#modal-edit #image").val("");

                    $("#modal-edit #prev-image img").css("display", "none");
                    $("#modal-edit #prev-image img").attr("src", "");
                    d_image = true;
                });

                let rules = {
                    description: "required",
                    image: {
                        maxsize: 2048000,
                        extension: "jpg|jpeg|png"
                    }
                };

                let message = {
                    description: {
                        required: "Kolom harus diisi!"
                    },
                    image: {
                        maxsize: "Ukuran maksimal foto 2 MB",
                        extension:
                            "File harus berekstensikan *.jpg, *.jpeg atau *.png"
                    }
                };

                formValidationEdit(
                    "#form-edit",
                    rules,
                    message,
                    "/kajian/ubah",
                    "POST"
                );
            }
        });

        this.setModalEdit("#modal-edit");
    }
}
