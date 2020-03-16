
var listQS_ = "https://api.banghasan.com/quran/format/json/surat";

getQS();

function getQS() {
    $.ajax({
        url: listQS_,
        method: "GET",
        dataType: "JSON",
        success: res => {
            $('#list-qs').html('');
            $("._QSnama").html("");
            $(".btnQS").html("")

            $("#lay_w").removeClass("container-fluid");
            $("#lay_w").addClass("container");

            $.each(res.hasil, (k, v) => {
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
                                <li>Jumlah ayat <b>${v.ayat}</b></li>
                                <li>
                                    <a href="javascript:void(0)" id="bacaQS" data-id="${v.nomor}" data-qs="${v.nama}">Baca Al-Quran</a>
                                </li>
                            </ul>
                        </div>
                        <div class="bottom-part">
                            <a class="primary-btn text-uppercase" href="#" data-toggle="modal" data-target="#ks-${v.nomor}">Keterangan Surat</a>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="ks-${v.nomor}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
            $("#list-qs").on("click", "#bacaQS", function() {
                var _noQS = $(this).data("id");
                var _namaQS = $(this).data("qs");
                getQS_Ayat(_noQS, _namaQS)
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

function getQS_Ayat(NoQS, QSnama){
    var $range = 10;
    $.ajax({
        url: 'https://al-quran-8d642.firebaseio.com/surat/'+NoQS+'.json?print=pretty',
        // url: listQS_ + "/"+ NoQS +"/ayat/1-"+$range,
        method: 'GET',
        dataTypo: 'JSON',
        success: (res) => {
            $('#list-qs').html('')
            $("._QSnama").html("QS "+ QSnama);
            $(".btnQS").html("")
            $(".btnQS").append(`
                <a class="primary-btn text-uppercase" href="javascript:void(0)" onclick="getQS()">Semua Surah</a>
            `);

            $("#lay_w").removeClass("container");
            $("#lay_w").addClass("container-fluid");

            $.each(res, (k, v) => {

                $("#list-qs").append(
                    `
                    <div class="col-lg-12 col-md-12 mb-10">
                        <div class="single-price">
                            <div class="top-part text-right">
                                <h4>
                                    <p class="arab mb-2" style="line-height: 250%;">${
                                        v.ar
                                    } (${v.nomor.toArabicDigits()})</p>
                                </h4>
                                <p>${v.tr}</p>
                            </div>
                            <div class="top-part text-left">
                            <blockquote class="generic-blockquote">` +
                        v.id +
                        `</blockquote>
                            </div>
                        </div>
                    </div>
                `
                );
            });
        }
    })
}

searchQS()
function searchQS() {
    var cariQS = $('#cariQS');
    cariQS.keyup(() => {
        $("#list-qs").html('');
        var expression = new RegExp(cariQS.val(), "i");
        $.getJSON(listQS_, (data) => {
            $.each(data.hasil, (k, v) => {
                if (
                    v.nama.search(expression) != -1 ||
                    v.arti.search(expression) != -1 ||
                    v.nomor.search(expression) != -1
                ) {
                    console.clear();

                    console.log("Nama = " + v.nama.search(expression.lastIndex));
                    console.log("Arti = " + v.arti.search(expression.lastIndex));
                    console.log("Nomor = " +v.nomor.search(expression.lastIndex));

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
                                            <li>Jumlah ayat <b>${v.ayat}</b></li>
                                            <li>
                                                <a href="javascript:void(0)" id="bacaQS" data-id="${v.nomor}" data-qs="${v.nama}">Baca Al-Quran</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bottom-part">
                                        <a class="primary-btn text-uppercase" href="#" data-toggle="modal" data-target="#ks-${v.nomor}">Keterangan Surat</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="ks-${v.nomor}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                }

            })
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
