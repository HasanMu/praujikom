var host = "https://api.banghasan.com/sholat/format/json/";

/**
 * =========================
 * JS Halaman Jadwal Home
 * =========================
 */

getKota();

function getKota() {
    $.ajax({
        url: host + 'kota',
        method: "GET",
        success: (res) => {
            if(res.status === "ok") {
                $('#search_kabko').text('')
                $.each(res.kota, (k, v) => {
                    $("#search_kabko").append(`
                        <option value="${v.id}">${v.nama}</option>
                    `);
                })
            }
        }
    })
}

$('#search_kabko').on('change', function() {
    getJadwalSholat($(this).val());
})

function getJadwalSholat(kota) {
    var _kota = kota;
    var today = new Date();

    var _date =
        today.getFullYear() +
        "-" +
        ("0" + (today.getMonth() + 1)).slice(-2) +
        "-" +
        ("0" + today.getDate()).slice(-2);

    $.ajax({
        url: host + "jadwal/kota/"+_kota+"/tanggal/"+_date,
        method: "GET",
        success: (res) => {
            $(".jadwal-sholat-sekarang").html('');
            $(".kota-dipilih").html('');
            $(".kota-dipilih").html("");

            $.ajax({
                url: host + "kota/kode/" + _kota,
                method: 'GET',
                success: (scs) => {
                    $(".kota-dipilih").text(scs.kota[0].nama);
                },
                error: (er) => {
                    console.log(er);
                }
            });

            $.each(res.jadwal.data, (k, v) => {

                const arr = ['subuh', 'dzuhur', 'ashar', 'maghrib', 'isya'];

                if(k != 'tanggal'){
                    $(".jadwal-sholat-sekarang").append(`
                        <div class="col-lg-4 col-md-6">
                            <div class="single-feature">
                                <a href="#" class="title d-flex flex-row">
                                    <span class="lnr lnr-user"></span>
                                    <h4>${toTitleCase(k)}</h4>
                                </a>
                                <p>
                                    Jadwal Sholat <b>${toTitleCase(
                                        k
                                    )}</b> pada jam ${v}
                                </p>
                            </div>
                        </div>
                    `);
                }
            })
        }
    });
}

/**
 * =========================
 * JS Halaman Jadwal Sholat
 * =========================
 */

Kota();

function Kota() {
    $.ajax({
        url: host + "kota",
        method: "GET",
        success: res => {
            if (res.status === "ok") {
                $("#semua-kota").text("");
                $.each(res.kota, (k, v) => {
                    $("#semua-kota").append(`
                    <option value="${v.id}">${v.nama}</option>
                `);
                });
            }
        }
    });
}

$("#cari-jadwal-sholat").on('click', function (e) {
    e.preventDefault()

    var kota_ = $("#semua-kota").val();
    var waktu_ = $("#waktu-jadwal-sholat")
        .datepicker({
            dateFormat: "yy/mm/dd"
        })
        .val();

    if(kota_  == '' || waktu_ == '') {
        alert('Kolom Kabupaten/Kota atau Waktu tidak boleh kosong!')
    }

    if(kota_ && waktu_)
    {
        JadwalSholat(kota_, waktu_)
    }

});

function JadwalSholat(kota, waktu) {
    var _kota = kota;
    var _waktu = waktu

    $.ajax({
        url: host + "jadwal/kota/" + _kota + "/tanggal/" + _waktu,
        method: "GET",
        success: res => {
            $(".jadwal-sholat-sekarang").html("");
            $("#keterangan-jadwal-sholat").html("");

            $.ajax({
                url: host + "kota/kode/" + _kota,
                method: "GET",
                success: (scs) => {
                    $("#keterangan-jadwal-sholat").append(`
                    <div class="col-md-12">
                        <hr>
                        <h6>Jadwal Sholat Kota <b>${scs.kota[0].nama}</b></h6>
                        <h4>${res.jadwal.data['tanggal']}</h4>
                    </div>
                    `);
                },
                error: er => {
                    console.log(er);
                }
            });

            $.each(res.jadwal.data, (k, v) => {
                const arr = ["subuh", "dzuhur", "ashar", "maghrib", "isya"];

                if (k != "tanggal") {
                    $(".jadwal-sholat-sekarang").append(`
                    <div class="col-lg-4 col-md-6">
                        <div class="single-feature">
                            <a href="#" class="title d-flex flex-row">
                                <span class="lnr lnr-user"></span>
                                <h4>${toTitleCase(k)}</h4>
                            </a>
                            <p>
                                Jadwal Sholat <b>${toTitleCase(
                                    k
                                )}</b> pada jam ${v}
                            </p>
                        </div>
                    </div>
                `);
                }
            });
        }
    });
}

/**
 * ==================
 * Kelengkapan JS
 * ==================
 */

function toTitleCase(str) {
    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}
