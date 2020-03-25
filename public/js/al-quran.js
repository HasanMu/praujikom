$(document).ready(function() {
    var base_url = window.location.origin;
    // var host = window.location.host;
    var url = base_url + "/api/v1/quran/surah/";

    getQS();

    function getQS() {
        $.ajax({
            url: url,
            method: "GET",
            dataType: "JSON",
            success: res => {
                $('#FQS').text('')
                $("#list-qs").html("");
                $("._QSnama").html("");
                $(".btnQS").html("");

                $("#lay_w").removeClass("container-fluid");
                $("#lay_w").addClass("container");

                $("#FQS").append(
                    `
                        <div class="single-price">
                            <div class="top-part text-right">
                                <div class="form-group row">
                                    <label for="cariQS" class="col-sm-2 col-form-label">Cari QS</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="cariQS" placeholder="Nama QS, Arti, Jenis (Mekah/Madinah)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                );

                $.each(res.data, (k, v) => {
                    $("#list-qs").append(`
                    <div class="col-lg-3 col-md-6 mb-10">
                        <div class="single-price">
                            <div class="top-part text-center">
                                <h4 class="arab">${v.asma}</h4>
                                <p>${v.nama} <br>(${v.arti})</p>
                            </div>
                            <div class="package-list">
                                <ul>
                                    <li>Diturunkan di <b>${v.type}</b></li>
                                    <li>Jumlah ayat <b>${v.jml_ayat}</b></li>
                                    <li>
                                        <a href="javascript:void(0)" id="bacaQS" data-id="${v.id}" data-qs="${v.nama}">Baca Al-Quran</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="bottom-part">
                                <a class="primary-btn text-uppercase" href="#" data-toggle="modal" data-target="#ks-${v.id}">Keterangan Surat</a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="ks-${v.id}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Keterangan <b>QS ${v.nama}</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="generic-blockquote">${v.keterangan}</blockquote>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="genric-btn primary radius" data-dismiss="modal">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `);
                });
                $("#list-qs").on("click", "#bacaQS", function(e) {
                    $(this).dblclick(function() {
                        return false;
                    });
                    e.preventDefault();
                    var _noQS = $(this).data("id");
                    var _namaQS = $(this).data("qs");
                    getQS_Ayat(_noQS, _namaQS);
                });
            },
            error: err => {
                console.log(err);
            }
        });
    }

    /**
     * ==========================
     * LIST PER QS
     * ==========================
     */

    function getQS_Ayat(NoQS, QSnama, page = '') {
        let paging = $('.paging')
        $.ajax({
            url: (page) ? page : url + NoQS + '/pagination/10',
            method: "GET",
            dataTypo: "JSON",
            success: res => {

                console.log(page);


                $('#FQS').text('')
                $("#list-qs").html("");
                $("._QSnama").html("QS " + QSnama);
                $(".btnQS").html("");
                $(".btnQS").append(`
                    <a class="primary-btn text-uppercase getQS" href="javascript:void(0)">Semua Surah</a>
                `);
                $('.getQS').click(() => {
                    getQS()
                })

                $("#lay_w").removeClass("container");
                $("#lay_w").addClass("container-fluid");

                $.each(res.data.data, (k, v) => {
                    paging.html('')
                    let nx = res.data.prev_page_url
                        ? `<a name="" id="prev-page" class="genric-btn primary circle arrow" href="javascript:void(0)" role="button" data-url="${res.data.prev_page_url}">Sebelumnya</a>`
                        : "<p></p>";
                    let pr = res.data.next_page_url
                        ? `<a name="" id="next-page" class="genric-btn primary circle arrow" href="javascript:void(0)" role="button" data-url="${res.data.next_page_url}">Selanjutya</a>`
                        : "<p></p>";
                    paging.append(
                        nx + " " + pr
                    );
                    console.clear();



                    $("#list-qs").append(
                        `
                        <div class="col-lg-12 col-md-12 mb-10">
                            <div class="single-price">
                                <div class="top-part text-right">
                                    <h4>
                                        <p class="arab mb-2" style="line-height: 250%;">${
                                            v.arab
                                        } (${v.ayat.toArabicDigits()})</p>
                                    </h4>
                                    <p>${v.latin}</p>
                                </div>
                                <div class="top-part text-left">
                                <blockquote class="generic-blockquote">` +
                            v.arti +
                            `</blockquote>
                                </div>
                            </div>
                        </div>
                    `
                    );
                });

                $('#next-page').on('click', (e) => {
                    e.preventDefault();

                    let next = $("#next-page").data('url');

                    getQS_Ayat(NoQS, QSnama, next)
                });

                $("#prev-page").on("click", e => {
                    e.preventDefault();

                    let prev = $("#prev-page").data("url");

                    getQS_Ayat(NoQS, QSnama, prev);
                });
            }
        });
    }

    cariQS();

    appendNodes = filteredQS => {
        const id_LQS = $("#list-qs");


        if (filteredQS != "no results") {
            id_LQS.text("");

            filteredQS.map((v) => {
                // console.log(v);

                id_LQS.append(`
                    <div class="col-lg-3 col-md-6 mb-10">
                        <div class="single-price">
                            <div class="top-part text-center">
                                <h4 class="arab">${v.asma}</h4>
                                <p>${v.nama} <br>(${v.arti})</p>
                            </div>
                            <div class="package-list">
                                <ul>
                                    <li>Diturunkan di <b>${v.type}</b></li>
                                    <li>Jumlah ayat <b>${v.jml_ayat}</b></li>
                                    <li>
                                        <a href="javascript:void(0)" id="bacaQS" data-id="${v.id}" data-qs="${v.nama}">Baca Al-Quran</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="bottom-part">
                                <a class="primary-btn text-uppercase" href="#" data-toggle="modal" data-target="#ks-${v.id}">Keterangan Surat</a>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="ks-${v.id}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Keterangan <b>QS ${v.nama}</b></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <blockquote class="generic-blockquote">${v.keterangan}</blockquote>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="genric-btn primary radius" data-dismiss="modal">
                                        Tutup
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            });
        } else {
            id_LQS.text('')
            id_LQS.append(`
                <div class="col-lg-12 col-md-12 mb-5">
                    <div class="single-price">
                        <div class="top-part text-center">
                            <p>Tidak ada hasil untuk ditampilkan!</p>
                        </div>
                    </div>
                </div>
            `);
        }
    };

    function cariQS() {
        $("#FQS").append(`
            <div class="single-price">
                <div class="top-part text-right">
                    <div class="form-group row">
                        <label for="cariQS" class="col-sm-2 col-form-label">Cari QS</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="cariQS" placeholder="Nama QS, Arti, Jenis (Mekah/Madinah)">
                        </div>
                    </div>
                </div>
            </div>
        `);

        $('body').on('keyup', $("#cariQS"), () => {

            $.getJSON(url, res => {

                let filterQS = res.data.filter((x) => {
                    return (
                        x.nama.toLowerCase().includes(
                            $("#cariQS")
                                .val()
                                .toLowerCase()
                        ) ||
                        x.arti.toLowerCase().includes(
                            $("#cariQS")
                                .val()
                                .toLowerCase()
                        ) ||
                        x.type.toLowerCase().includes(
                            $("#cariQS")
                                .val()
                                .toLowerCase()
                        )
                    );
                });


                if (filterQS.length > 0) {
                    appendNodes(filterQS);

                } else {
                    appendNodes("no results");
                }
            })
        })

    }

    /**
     * =================
     * Lain - Lain
     * =================
     */

    String.prototype.toArabicDigits = function() {
        var id = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        return this.replace(/[0-9]/g, function(w) {
            return id[+w];
        });
    };
});
