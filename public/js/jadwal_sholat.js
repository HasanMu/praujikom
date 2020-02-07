// import { waktu } from "./bagian-waktu";

var host = "https://api.banghasan.com/sholat/format/json/";

let waktu = {
    wita: [
        // Bali
        "BADUNG",
        "BANGLIO",
        "BULELENG",
        "GIANYAR",
        "JEMBRANA",
        "KARANGASEM",
        "KLUNGKUNG",
        "TABANAN",
        "DENPASAR",
        // NTB
        "BIMA",
        "KOTA BIMA",
        "DOMPU",
        "LOMBOK BARAT",
        "LOMBOK TENGAH",
        "LOMBOK TIMUR",
        "LOMBOK UTARA",
        "SUMBAWA",
        "SUMBAWA BARAT",
        "KOTA MATARAM",
        // NTT
        "ALOR",
        "BELU",
        "ENDE",
        "FLORES TIMUR",
        "KOTA KUPANG",
        "KUPANG",
        "LEMBATA",
        "MALAKA",
        "MANGGARAI",
        "MANGGARAI BARAT",
        "MANGGARAI TIMUR",
        "NAGEKEO",
        "NGADA",
        "ROTE NDAO",
        "SABURAIJUA",
        "SIKKA",
        "SUMBA BARAT",
        "SUMBA BARAT DAYA",
        "SUMBA TENGAH",
        "SUMBA TIMUR",
        "TIMOR TENGAH SELATAN",
        "TIMOR TENGAH UTARA",
        // KALIMANTAN SELATAN
        "BALANGAN",
        "BANJAR",
        "BARITOKUALA",
        "HULUSUNGAI SELATAN",
        "HULUSUNGAI TENGAH",
        "HULUSUNGAI UTARA",
        "KOTABARU",
        "TABALONG",
        "TANAHBUMBU",
        "TANAHLAUT",
        "TAPIN",
        "KOTA BANJARBARU",
        "KOTA BANJARMASIN",
        // KALIMANTAN TIMUR
        "BERAU",
        "KUTAI BARAT",
        "KUTAI KARTANEGARA",
        "KUTAI TIMUR",
        "MAHAKAM ULU",
        "PASER",
        "PENAJAM PASER UTARA",
        "KOTA BALIKPAPAN",
        "KOTA BONTANG",
        "KOTA SAMARINDA",
        // KALIMANTAN UTARA
        "BULUNGAN",
        "MALINAU",
        "NUNUKAN",
        "TANA TIDUNG",
        "KOTA TARAKAN",
        // SULAWESI UTARA
        "BOLAANGMONGONDOW",
        "BOLAANGMONGONDOW SELATAN",
        "BOLAANGMONGONDOW TIMUR",
        "BOLAANGMONGONDOW UTARA",
        "KEPULAUAN SANGIHE",
        "KEPULAUAN SIAU TAGULANDANG BIARO",
        "KEPULAUAN TALAUD",
        "MINAHASA",
        "MINAHASA SELATAN",
        "MINAHASA TENGGARA",
        "MINAHASA UTARA",
        "KOTA BITUNG",
        "KOTA KOTAMOBAGU",
        "KOTA MANADO",
        "KOTA TOMOHON",
        // GORONTALO
        "BOALEMO",
        "BONEBOLANGO",
        "GORONTALO",
        "GORONTALO UTARA",
        "POHUWATO",
        "KOTA GORONTALO",
        // SULAWESI TENGAH
        "BANGGAI",
        "BANGGAI KEPULAUAN",
        "BANGGAI LAUT",
        "BUOL",
        "DONGGALA",
        "MOROWALI",
        "MOROWALI UTARA",
        "PARIGIMOUTONG",
        "POSO",
        "SIGI",
        "TOJOUNAUNA",
        "TOLITOLI",
        "KOTA PALU",
        // SULAWESI BARAT
        "MAJENE",
        "MAMASA",
        "MAMUJU",
        "MAMUJU TENGAH",
        "POLEWALI MANDAR",
        // SULAWESI SELATAN
        "BANTAENG",
        "BARRU",
        "BONE",
        "BULUKUMBA",
        "ENREKANG",
        "GOWA",
        "JENEPONTO",
        "SELAYAR",
        "LUWU",
        "LUWU TIMUR",
        "LUWU UTARA",
        "MAROS",
        "PANGKAJENE KEPULAUAN",
        "PINRANG",
        "SIDENRENGRAPPANG",
        "SINJAI",
        "SOPPENG",
        "TAKALAR",
        "TANATORAJA",
        "TORAJA UTARA",
        "WAJO",
        "KOTA MAKASSAR",
        "KOTA PALOPO",
        "KOTA PARE-PARE",
        // SULAWESI TENGGARA
        "BOMBANA",
        "BUTON",
        "BUTON UTARA",
        "KOLAKA",
        "KOLAKA TIMUR",
        "KOLAKA UTARA",
        "KONAWE",
        "KONAWE KEPULAUAN",
        "KONAWE SELATAN",
        "KONAWE UTARA",
        "MUNA",
        "WAKATOBI",
        "KOTA BAU-BAU",
        "KOTA KENDARI"
    ],
    wit: [
        // MALUKU
        "BURU",
        "BURU SELATAN",
        "KEPULAUAN ARU",
        "MALUKU BARAT DAYA",
        "MALUKU TENGAH",
        "MALUKU TENGGARA",
        "MALUKU TENGGARA BARAT",
        "SERAM BAGIAN BARAT",
        "SERAM BAGIAN TIMUR",
        "KOTA AMBON",
        "KOTA TUAL",
        // MALUKU UTARA
        "HALMAHERA BARAT",
        "HALMAHERA SELATAN",
        "HALMAHERA TENGAH",
        "HALMAHERA TIMUR",
        "HALMAHERA UTARA",
        "KEPULAUAN SULA",
        "PULAU MOROTAI",
        "PULAU TALIABU",
        "KOTA TERNATE",
        "KOTA TIDORE",
        // PAPUA
        "ASMAT",
        "BIAKNUMFOR",
        "BOVENDIGOEL",
        "DEIYAI",
        "DOGIYAI",
        "INTAN JAYA",
        "JAYAPURA",
        "JAYAWIJAYA",
        "KEEROM",
        "KEPULAUAN YAPEN",
        "LANNY JAYA",
        "MAMBERAMO RAYA",
        "MAMBERAMO TENGAH",
        "MAPPI",
        "MERAUKE",
        "MIMIKA",
        "NABIRE",
        "NDUGA",
        "PANIAI",
        "PEGUNUNGAN BINTANG",
        "PUNCAK",
        "PUNCAKJAYA",
        "SARMI",
        "SUPIORI",
        "TOLIKARA",
        "WAROPEN",
        "YAHUKIMO",
        "YALIMO",
        "KOTA JAYAPURA",
        // PAPUA BARAT
        "FAK-FAK",
        "KAIMANA",
        "MANOKWARI",
        "MANOKWARI SELATAN",
        "MAYBRAT",
        "PEGUNUNGAN ARFAK",
        "RAJAAMPAT",
        "SORONG",
        "SORONG SELATAN",
        "TAMBRAUW",
        "TELUKBINTUNI",
        "TELUKWONDAMA",
        "KOTA SORONG"
    ]
};

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
                $("#search_kabko").select2();
                $("#search_kabko").append(`<option value="">-- Pilih lokasi --</option>`)
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

            $.ajax({
                url: host + "kota/kode/" + _kota,
                method: "GET",
                success: s => {
                    let bagWaktu = 'WIB';
                    waktu.wita.find(w => {
                        if(w == s.kota[0].nama) {
                            return bagWaktu = 'WITA';
                        }
                    });
                    waktu.wit.find(w => {
                        if (w == s.kota[0].nama) {
                            return bagWaktu = 'WIT';
                        }
                    });
                    $_n = 0;
                    $.each(res.jadwal.data, (k, v) => {
                        const arr = [
                            "ASHAR",
                            "DHUHA",
                            "DZUHUR",
                            "ISYA",
                            "MAGHRIB",
                            "SHUBUH"
                        ];

                        if (k != "tanggal" && k != "terbit" && k != "imsak") {
                            $(".jadwal-sholat-sekarang").append(`
                                <div class="col-lg-4 col-md-6">
                                    <div class="single-feature">
                                        <a href="#" class="title d-flex flex-row">
                                            <img src="/assets/images/clocks/${arr[$_n++]}.png" class="img-fluid" style="width: 20px; height: 20px;"> &nbsp;
                                            <h4>${toTitleCase(k)}</h4>
                                        </a>
                                        <p>
                                            Jadwal Sholat <b>${toTitleCase(
                                                k
                                            )}</b> pada jam ${v} ${bagWaktu}
                                        </p>
                                    </div>
                                </div>
                            `);
                        }
                    });
                },
                error: f => {
                    console.log(f);
                }
            });
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
